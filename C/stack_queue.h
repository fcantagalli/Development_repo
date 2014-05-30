#ifndef STACK_QUEUE_H_INCLUDED
#define STACK_QUEUE_H_INCLUDED

#define TRUE 1;
#define FALSE 0;

typedef struct Info{
	char* firstName;
	char* lastName;
	long puid;
	int age;
}Info;

typedef struct Node{
	struct Info data;
	struct Node* next;
}Node;

typedef struct Stack{
	struct Node* top;
	int nElements;
}Stack;

typedef struct Queue{
	struct Node* begin;
	struct Node* end;
	int nElements;
}Queue;

// Stack methods
void printStack(Stack* s);
void push(Stack* stack ,Info data); //- pushes a data node onto the top of the stack. This function will need a parameter of the data type stored in the stack.
Node pop(Stack* stack); //- Takes the top node off the stack and returns the data to the program.
int Stack_size(Stack* stack);// - returns the size of the stack in terms of the number of nodes.
int Stack_empty(Stack* stack); // - returns a boolean, true if the stack has no nodes and false if the stack has greater than 0 nodes.
void initStack(Stack* stack); // initialize stack;

// Node
Node* createNode(struct Info data);

// Queue methods
void printQueue(Queue* q); // print the first name of the elements in the Queue
void enqueue(Queue* q, Info data);// - adds a data node onto the back of the queue. This function will need a parameter of the data type stored in the queue.
Node dequeue(Queue* q); // - Takes the front node from the queue and returns the data to the program.
int queue_size(Queue* q);// - returns the size of the queue in terms of the number of nodes.
int queue_empty(Queue* q);// - returns a boolean, true if the queue has no nodes and false if the queue has greaterthan 0 nodes.
void initQueue(Queue* q); // initialize Queue

//interface
void print_menu();
Info getData();
#endif
