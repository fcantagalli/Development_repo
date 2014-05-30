#ifndef Lab7_tree_h
#define Lab7_tree_h

typedef struct Node{
	int data;
	struct Node* left;
	struct Node* right;
}Node;

typedef struct Tree{
	struct Node* root;
	int nElements;
}Tree;

void CreateTree0(Tree*); //- create an empty binary tree with just a root pointer.
void CreateTree1(Tree * tree, int data);// - create a binary tree with 1 root node, given the int parameter.
int AddNode(Node* node, Node* root, Tree* tree);// - add a node to the tree, in the correct, ordered position, given the Node parameter.
int AddNodeI(int data, Node* root, Tree* tree); //- add a node to the tree, in the correct, ordered position, given the int value parameter.
Node DeleteNode(int data, Node* current, Node* parent, Tree* tree);// - delete a node from the tree and maintain the correct ordering of the tree. The parameter is the value of the Node to delete.
int TraverseFind(int, Node* root); //- search the binary tree for the value passed as a parameter. Return true if found and false if not found, in the tree.
void TraversePrint(Node* root); //- print out all values in the tree, in correct numerical order.
Node* createNode(int);

#endif