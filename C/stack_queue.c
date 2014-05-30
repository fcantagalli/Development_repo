
#include <stdio.h>
#include "stack_queue.h"
#include <stdlib.h>
#include <string.h>

static const struct Node EMPTYNODE;

/*
typedef struct Info{
	char* firstName;
	char* lastName;
	long puid;
	int age;
} Info;
*/

int main()
{	
	Info f = getData();
	Stack stack;
	Queue queue;

	initStack(&stack);
	initQueue(&queue);

	push(&stack,f); // put node on stack
	enqueue(&queue,f); // put node on queue

	print_menu();

	char option[5];

	while(1){
		if(scanf("%s",option) == 1){ // is a valid type

			if(strcmp(option,"add") == 0){
				//add a new node
				f = getData();

				push(&stack,f); // put node on stack
				enqueue(&queue,f); // put node on queue

			}
			else if(strcmp(option,"eq") == 0){
				int size = queue_size(&queue);
				int i;
				for(i = 0; i < size; i++){
					dequeue(&queue);
				}
			}
			else if(strcmp(option,"es") == 0){
				int size = Stack_size(&stack);
				int i;
				for(i=0;i < size; i++){
					pop(&stack);
				}
			}
			else if(strcmp(option,"pq") == 0){
				printQueue(&queue);
				// print queue
			}
			else if(strcmp(option,"ps") == 0){
				printStack(&stack);
				//print stack
			}
			else if(strcmp(option,"exit") == 0){
				return TRUE; // exit
			}
		}
		print_menu();
	}
	return TRUE;
}

void print_menu()
{
	printf("\n\n");
	printf(" add : AddNode - add another node to the system\n");
	printf(" eq : Empty Queue - remove all of the nodes from the queue\n");
	printf(" es : Empty Stack - remove all of the nodes dro mthe stack\n");
	printf(" pq : Print Queue - print the nodes of the Queue in the order of arrival into the queue\n");
	printf(" ps : Print Stack - print the nodes of the Stack, wich should be the reverse of the Queue\n");
	printf(" exit : Exit - exit the program\n\n"); 
}

Info getData(){

	Info data;
	char buffer[50];
	printf(" Enter the informations to store in the Node\n");
	while(1){
		printf(" First Name : ");		
		if(scanf("%s",buffer) == 1){
			//printf("string size %u\n",(unsigned) strlen(buffer));
			data.firstName = (char*) malloc(strlen(buffer)+1);
			strcpy(data.firstName,buffer);
			//free(data.firstName);
			//printf(" name : %s \n",data.firstName);
			break;
		}
		else printf("wrong input, try again\n");
	}
	
	while(1){
		printf(" Last Name : ");		
		if(scanf("%s",buffer) == 1){
			data.lastName = (char*) malloc(strlen(buffer)+1);
			strcpy(data.lastName,buffer);
			//free(data.lastName);
			break;
		}
		else printf("wrong input, try again\n");
	}

	while(1){
		printf("Enter the PUID : ");
		if(scanf("%ld",&data.puid) == 1){
			break;
		}
		else printf("wrong input, try again\n");
	}

	while(1){
		printf("Enter the age : ");
		if(scanf("%d",&data.age) == 1){
			break;
		}
		else printf("wrong input, try again\n");
	}

	return data;
}

// stack functions
void push(Stack* stack ,Info data)
{
	Node* n = createNode(data);

	if(stack->top == NULL){ // first element;
		n->next = NULL;
		stack->top = n;
	}
	else{
		n->next = stack->top;
		stack->top = n;
	}
	
	stack->nElements++;
}

//- Takes the top node off the stack and returns the data to the program.
Node pop(Stack* stack)
{

	if(stack->nElements == 0){
		printf("empty stack");
		return EMPTYNODE;
	}

	Node* poped;

	poped = stack->top;
	stack->top = stack->top->next;
	stack->nElements--;

	Node aux = *poped;
	free(poped);
	return aux;
} 

// - returns the size of the stack in terms of the number of nodes.
int Stack_size(Stack* stack)
{
	return stack->nElements;
}
// - returns a boolean, true if the stack has no nodes and false if the stack has greater than 0 nodes.
int Stack_empty(Stack* stack)
{
	if(stack->nElements <= 0){// it should never be less than 0
		return TRUE; 
	} 
	else{
		return FALSE;
	} 
}

void printStack(Stack* s)
{
	Node* aux = s->top;

	if(aux == NULL) {
		printf("empty list\n");
		return;
	}
	else{
		printf("[top]   ");
		while(aux != NULL){
			printf("%s - ",aux->data.firstName);
			aux = aux->next;
		}

	}
	printf("   [botton]" );
	printf("\t number of elements: %d ",s->nElements);
	printf("\n");
}

Node* createNode(Info data){
	Node* n = (Node*) malloc(sizeof(Node));

	n->data.firstName = data.firstName;
	n->data.lastName = data.lastName;
	n->data.puid = data.puid;
	n->data.age = data.age;
	n->next = NULL;

	return n;
}

 // initialize stack;
void initStack(Stack* stack)
{
	stack->top = NULL;
	stack->nElements = 0;
}

// - adds a data node onto the back of the queue. This function will need a parameter of the data type stored in the queue.
void enqueue(Queue* q, Info data)
{
	Node* n = createNode(data);

	if(q->begin == NULL){ // first element.
		q->begin = n;
		q->end = n;
		n->next = NULL;
	}
	else{
		q->end->next = n;
		q->end = n;
		n->next = NULL; // just to make sure
	}

	q->nElements++;
}

// - Takes the front node from the queue and returns the data to the program.
Node dequeue(Queue* q)
{
	if(queue_size(q) == 0){
		printf("empty queue");
		return EMPTYNODE;
	}
	else{
		Node* temp = q->begin;
		q->begin = q->begin->next;
		q->nElements--;
		if(q->begin == NULL) q->end = NULL; // it was the last element
	
		Node result = *temp;
		free(temp);
		return result;	
	}
}

// - returns the size of the queue in terms of the number of nodes.
int queue_size(Queue* q)
{
	return q->nElements;
}

// - returns a boolean, true if the queue has no nodes and false if the queue has greaterthan 0 nodes.
int queue_empty(Queue* q)
{
	if(queue_size(q) == 0){
		return TRUE;
	}
	else{
		return FALSE;
	}
}

void printQueue(Queue* q)
{
	Node* aux = q->begin;

	if(aux == NULL) {
		printf("empty list\n");
		return;
	}
	else{
		printf("[begin]   ");
		while(aux != NULL){
			printf("%s - ",aux->data.firstName);
			aux = aux->next;
		}

	}
	printf("   [end]" );
	printf("\t number of elements: %d ",q->nElements);
	printf("\n");
}

void initQueue(Queue* q)
{
	q->begin = NULL;
	q->end =  NULL;
	q->nElements = 0;
}
