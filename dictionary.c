/**
 * dictionary.c
 *
 * Computer Science 50
 * Problem Set 5
 *
 * Implements a dictionary's functionality.
 */

#include <stdbool.h>
#include <cs50.h>
#include <ctype.h>


#include "dictionary.h"

typedef struct alphabet{
    struct alphabet* letter[27];
    bool eow;
}node;
node* root;
int wn=0;
/**
 * Returns true if word is in dictionary else false.
 */
bool check(const char* word)
{
    //reset if caps
    node* finger=root;
    int i,j=strlen(word);
    char cw[j];
    for(i=0;i<j;i++){
        cw[i]=tolower(word[i]);
        if(isalpha(cw[i])){
            if(finger->letter[25-('z'-cw[i])]!=NULL){
                finger=finger->letter[25-('z'-cw[i])];
            }
            else{
                return false;
            }
        }
        else{
            if(finger->letter[26]!=NULL){
                finger=finger->letter[26];
            }
            else{
                return false;
            }
        }
    }
    if(finger->eow==true){
        return true;
    }
    else{
        return false;
        }
    return false;
}

/**
 * Loads dictionary into memory.  Returns true if successful else false.
 */
bool load(const char* dictionary)
{
    root=(node *)malloc(sizeof(node));
    FILE* d= fopen(dictionary, "r");
    if (d == NULL)
    {
        printf("Could not open dictionary.\n");
        return false;
        
    }
    int sl,i;
    //int wl=0;
    char c[LENGTH+1];
    fscanf(d,"%s",c);
    sl=strlen(c);
    node* finger;
    while(!feof(d)){
        finger=root;
        //wl++;
        //printf("%s\n",c);
        //printf("%d",'z'-'a');
        for(i=0;i<sl;i++){
            if(isalpha(c[i])){
                if(finger->letter[25-('z'-c[i])]==NULL){
                    finger->letter[25-('z'-c[i])]=(node *)malloc(sizeof(node));
                }
                finger=finger->letter[25-('z'-c[i])];
            }
            else{
                if(finger->letter[26]==NULL){
                    finger->letter[26]=(node *)malloc(sizeof(node));
                }
                finger=finger->letter[26];
            }
            
        }
        wn++;
        finger->eow=true;
        fscanf(d,"%s",c);
        sl=strlen(c);
        }
    return true;
}

/**
 * Returns number of words in dictionary if loaded else 0 if not yet loaded.
 */
unsigned int size(void)
{
    if(wn!=0){
        return wn;
    }
    return 0;
    
}


//cheks up if a letter of node points somezhere, if it does it returns it's index else returns -1
int np(node* ptr){
    int r=-1;
    if(ptr==NULL){
        return r;
    }
    for(int i=0;i<27;i++){
        if(ptr->letter[i]!=NULL){
            r=i;
            i=27;
        }
    }
    return r;
}

/**
 * Unloads dictionary from memory.  Returns true if successful else false.
 */
bool unload(void)
{
    //bool done=false;
    int i;
    node* finger=root;
    while(np(root)!=-1){
        i=np(finger);
        if(i!=-1){
            finger=finger->letter[i];
        }
        else{
            free(finger);
            finger=root;
        }
    }
    free(root);
    return true;
}
