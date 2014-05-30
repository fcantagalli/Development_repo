// Includes
#include <stdio.h>
#include <stdlib.h>
#include "list.h"

// defines
#define TRUE 1
#define FALSE 0
#define NOT_FOUND -1
/*
typedef struct Info{
	char[] firstName;
	char[] lastName;
	long puid;
	int age;
};

typedef struct Node{
	Info data;
	struct Node* next;
} Node; 
 * Defines the structure of the list, that contains a pointer to the head and a counter to how many elements the list have.
 
typedef struct List{
	struct Node* head;
	int nElements;
} List;
*/

void printList(List* l)
{
	Node* aux = l->head;

	if(aux == NULL) {
		printf("empty list");
	}
	else{
		while(aux != NULL){
			printf("%s - ",aux->data.firstName);
			aux = aux->next;
		}

	}
	printf("\t number of elements: %d ",l->nElements);
	printf("\n");
}

int main()
{
	List l;

	//createListNoNodes(&l); // working

	Info data1;
	data1.firstName = "felipe";
	data1.lastName = "Cantagalli";
	data1.puid = 27296830;
	data1.age = 22;

	Info data2;
	data2.firstName = "bibi";
	data2.lastName = "letti";
	data2.puid = 12345678;
	data2.age = 20;

	Info data3;
	data3.firstName = "ricardo";
	data3.lastName = "cantagalli";
	data3.puid = 87654321;
	data3.age = 50;

	Info data4;
	data4.firstName = "suzete";
	data4.lastName = "tozato";
	data4.puid = 43256789;
	data4.age = 48;

	createListNode(&l,data1); // working

	printList(&l);

	insertFront(&l, data2); // working
	//insertFront(&l,data3);
	//insertFront(&l,data4);
	printList(&l);
	//insertEnd(&l, data2); //working
	insertEnd(&l,data3);
	insertFront(&l,data4);
	printList(&l);

	//insertMiddle(&l,data4,1); //working

	//deleteFront(&l); // working
	//deleteFront(&l);

	//deleteEnd(&l);
	//deleteEnd(&l);

	deleteMiddle(&l,1); // wroking
	//deleteMiddle(&l,1);

	printList(&l);


	//Node* n = lookUpByIndex(&l,1);
	//printf(" %s\n",n->data.firstName);
	//n = lookUpByIndex(&l,0);
	//printf(" %s\n",n->data.firstName);

	int aux = traverse(&l,27296831);
	//printf("funcionou ?! : %d",aux);

	return 0;
}

// initialize the linkedList with no node. It points on nothing and there is 0 elements
void createListNoNodes(List* l)
{
	l->head = NULL;
	l->nElements = 0;
}

// create a node with the data inputed and pointing to null
Node* createNode(Info data){
	Node* n = (Node*) malloc(sizeof(Node));

	n->data.firstName = data.firstName;
	n->data.lastName = data.lastName;
	n->data.puid = data.puid;
	n->data.age = data.age;
	n->next = NULL;

	return n;
}

// initialize the linkedList with a node. It the head point to the first element and there is 1 element.
void createListNode(List* l, Info data)
{
	Node* n = createNode(data);

	l->head = n;
	l->nElements = 1;
}

// - insert a node at the front of the list.
void insertFront(List*l, Info data)
{
	Node* n = createNode(data);

	n->next = l->head;
	l->head = n;
	(l->nElements)++;

}
// positions start in zero, like array
int insertMiddle(List* l,Info data, int position)
{
	// position invalid
	if(position > l->nElements || position < 0){
		printf("it is not possible to insert in position %d \n",position);
		return FALSE;
	}
	else{  // posisiton valid
		Node* n = createNode(data);

		if(position == 0){ //insert in the first element
			n->next = l->head;
			l->head = n;
			(l->nElements)++;
			return TRUE;
		}
		int i =0;
		Node* ant;
		Node* aux;
		aux = l->head;
		do{
			ant = aux;
			aux = aux->next;
			i++;
		}while(i < position);

		n->next = aux;
		ant->next = n;
		l->nElements++;
		return TRUE;
	}
}

void insertEnd(List* l, Info data)
{
	Node* n = createNode(data);

	Node* aux;

	aux = l->head;

	while(aux->next != NULL){
		aux = aux->next;
	}

	n->next = aux->next;
	aux->next = n;
	l->nElements++;
}

void deleteFront(List* l)
{
	// empty list
	if(l->nElements == 0) return;

	Node* aux = l->head;
	l->head = aux->next;
	l->nElements--;
	free(aux);
}

int deleteMiddle(List* l, int position)
{
	// position invalid
	if(l->nElements <= position || position < 0){
		printf("it is not possible to delete in position %d \n",position);
		return FALSE;
	}
	else{  // posisiton valid

		if(position == 0){ //delete in the first element
			deleteFront(l);
			return TRUE;
		}
		int i = 0;
		Node* ant;
		Node* aux;
		aux = l->head;
		do{
			ant = aux;
			aux = aux->next;
			i++;
		}while(i < position);

		ant->next = aux->next;
		free(aux);
		l->nElements--;
		return TRUE;
	}
}

void deleteEnd(List* l)
{
	// empty list
	if(l->nElements == 0) return;

	Node* aux;
	Node* ant;
	aux = l->head;

	while(aux->next != NULL){
		ant = aux;
		aux = aux->next;
	}

	ant->next = aux->next;
	free(aux);
	l->nElements--;

}

int traverse(List* l, long puid)
{
	if(l->nElements == 0) return FALSE;

	Node* aux = l->head;

	do{
		if(aux->data.puid == puid){
			//printf("achou");
			return TRUE;
		} 
		aux = aux->next;
	}while(aux != NULL);

	return FALSE;
}
// this function looks by a specific element based on its position.
// index is the position in the list.
Node* lookUpByIndex(List* l, int index)
{
	if(l->nElements <= index) return NOT_FOUND;

	Node* aux = l->head;

	int i;
	for(i = 0; i < index; i++){
		aux = aux->next;
	}
	return aux;
}
