#ifndef INTLIST_H_INCLUDED
#define INTLIST_H_INCLUDED

/*
 * Defines a node of the linked list
 */
typedef struct Info{
	char* firstName;
	char* lastName;
	long puid;
	int age;
} Info;

typedef struct Node{
	struct Info data;
	struct Node* next;
} Node; 
/*
 * Defines the structure of the list, that contains a pointer to the head and a counter to how many elements the list have.
 */
typedef struct List{
	struct Node* head;
	int nElements;
} List;



void createListNoNodes(List* l);// - create list with no nodes, just a start pointer.
Node* createNode(struct Info data);
void createListNode(List* l, struct Info data); // create list with a single node. Data to fill the node is the precondition and must be passed as a parameter.
void insertFront(List* l, struct Info data); // - insert a node at the front of the list.
int insertMiddle(List* l, struct Info data, int position); // - insert a node in the middle of the list. (Hint: use the data to know where to insert the node)
// it returns true if it was possible to insert, false, it was not possible.
void insertEnd(List* l, struct Info data);// - insert a node at the end of the list.
void deleteFront(List* l); // - delete the first node in the list.
int deleteMiddle(List* l, int position); // - delete a node in the middle of the list. (Hint: use the data to know where to delete the node)
void deleteEnd(List* l); //- delete a node at the end of the list.
int traverse(List* l, long puid); //- traverse the list based on some key value in the data portion of the node.
Node* lookUpByIndex(List* l, int index); // - find a particular node by an index number. Return -1 if that index does not exist.

#endif