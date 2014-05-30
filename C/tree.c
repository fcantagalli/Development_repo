
/**
*
*  Lab 7 - Binary Tree
* Author: Felipe Tozato Cantagalli
* PUID: 0027296830
*/
#include "tree.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

static const struct Node EMPTYNODE;

#define TRUE 1
#define FALSE 0
#define MY_ERROR -55555

void print_menu()
{
	printf(" a : add a node to the tree\n p : print the elements of the tree\n d : delete a node\n h : print menu to help\n l : look for a node\n e : exit the program\n\n");
}

int getData(){
	printf("Please, enter a interger : ");
	int data;
	if(scanf("%d",&data) != 1){ //error getting data
		printf("error getting the data\n");
		data = MY_ERROR;
	}

	printf("\n");
	return data;
}

int main()
{

	struct Tree tree;

	char option[5];

	printf("Would you like to initialize the tree with a node? type y or n\n");
	char c;
	if(scanf("%c",&c) == 1 && c == 'y'){
		int result = getData();
		// get data until it is ok.
		while(result == MY_ERROR){
			result = getData();
		}
		CreateTree1(&tree,result);
	}
	else{

		printf("Tree created withoud node\n\n");
		CreateTree0(&tree);
	}

	print_menu();
	while(TRUE){
		if( scanf("%s",option) == 1){ // input ok

			if( strcmp(option,"a") == 0){
				// add a node
				int result = getData();
				// get data until it is ok.
				while(result == MY_ERROR){
					result = getData();
				}
				int works = AddNodeI(result,tree.root,&tree);
				if(works == TRUE){
					printf("added \n");
				}
				else{
					printf("not added \n");
				}
			}
			else if( strcmp(option,"p") == 0){
				TraversePrint(tree.root);
				printf("\n");
			}
			else if( strcmp(option,"d") == 0){
				int result = getData();
				// get data until it is ok.
				while(result == MY_ERROR){
					result = getData();
				}
				Node n = DeleteNode(result,tree.root,NULL,&tree);
				if( n.data ){
					printf("%d : deleted \n",n.data);
				}
				else{
					printf("not deleted \n");
				}
			}
			else if( strcmp(option,"h") == 0){
				print_menu();
			}
			else if(strcmp(option,"l") == 0){
				int result = getData();
				// get data until it is ok.
				while(result == MY_ERROR){
					result = getData();
				}
				int found = TraverseFind(result,tree.root);
				if(found == TRUE){
					printf("Node Found\n");
				}
				else{
					printf("Node not found\n");
				}
			}
			else if( strcmp(option,"e") == 0){
				return 1;
			}
		}
	}	
	return 0;
}

void CreateTree0(Tree* tree)
{
	tree->root = NULL;
	tree->nElements = 0;
}

Node* createNode(int data){

	Node* n = (Node*) malloc(sizeof(Node));

	n->data = data;
	n->left = NULL;
	n->right = NULL;

	return n;
}

void CreateTree1(Tree* tree, int data)
{
	Node* n = createNode(data);

	tree->root = n;
	tree->nElements = 1;
}

int AddNode(Node* node, Node* root,Tree* tree)
{
	if(tree->nElements == 0){ //first element
		tree->root = node;
		tree->nElements = 1;
		return TRUE;
	}

	if(root == NULL){ //error
		printf("Error : Root NULL\n");
		return FALSE;
	}

	if(node->data < root->data){
		if(root->left == NULL){ //insert as left child
			root->left = node;
			tree->nElements++;
			return TRUE;
		}
		else{ //call this function to the subtree
			return	AddNode(node,root->left,tree);
		}

	}
	else if(node->data > root->data){
		if(root->right == NULL){ // insert as right child
			root->right = node;
			tree->nElements++;
			return TRUE;
		}
		else{ // call this function to the subtree
			return AddNode(node,root->right,tree);
		}
	}
	else{ // values are equal, dont insert
		printf("Node already exist. It's not possible to insert.\n");
		return FALSE;
	}

}

int AddNodeI(int i,Node* root, Tree* tree)
{
	Node* n = createNode(i);

	int result = AddNode(n,tree->root,tree);

	return result;
}

void TraversePrint(Node* root)
{

	if(root == NULL)
		return;
	TraversePrint(root->left);// go to the lowest values first
	printf("%d ",root->data);
	TraversePrint(root->right);
}

int TraverseFind(int data, Node* root)
{	
	if(root == NULL ){ // not found
		return FALSE;
	}

	if(data > root->data){
		return TraverseFind(data,root->right);
	}
	else if(data < root->data){
		return TraverseFind(data,root->left);
	}
	else{ // equal
		return TRUE;
	}
}

Node DeleteNode(int data, Node* current, Node* parent, Tree* tree)
{
	if(current == NULL) return EMPTYNODE; // data not found

	if(data > current->data){
		// call to the right.
		return DeleteNode(data,current->right,current,tree);
	}
	else if(data < current->data){
		// call to the left
		return DeleteNode(data,current->left,current,tree);
	}
	else{
		// data is equal. we have to delete.
		printf("found the node");
		Node* subs;
		if(current->left != NULL){
			subs = current->left;
			Node* subparent = NULL;
			// biggest child from the left
			while(subs->right != NULL){
				subparent = subs;
				subs = subs->right; 
			}

			subs->right = current->right;
			subs->left = current->left;
			if(subparent != NULL) subparent->right = NULL;
			if(parent != NULL){
				if(subs->data < parent->data){ // left child
					parent->left = subs;
				}
				else{ // child on the right
					parent->right = subs;
				}
			}

			tree->nElements--;
			Node aux = *current;
			free(current);
			return aux;
		}
		else if(current->right != NULL){
			subs = current->right;
			Node* subparent = NULL;
			// smallest child from the right
			while(subs->left != NULL){
				subparent = subs;
				subs = subs->left; 
			}

			subs->right = current->right;
			subs->left = current->left;
			if(subparent != NULL) subparent->left = NULL;
			if(parent != NULL){
				if(subs->data < parent->data){ // left child
					parent->left = subs;
				}
				else{ // child on the right
					parent->right = subs;
				}
			}

			tree->nElements--;
			Node aux = *current;
			free(current);
			return aux;
		}
		else{
			// node has no child, just delete
			if(parent != NULL){
				if(current->data < parent->data) parent->left = NULL;
				else parent->right = NULL;
			}

			tree->nElements--;
			Node aux = *current;
			free(current);
			return aux;
		}
	}

	return EMPTYNODE;
}

