#ifndef array_h   /* Include guard */
#define array_h

void printIntArray(int x[]);  /* An example function declaration */
void printCharArray(char x[]);
void printDoubleArray(double x[]);
void printFloatArray(float x[]);
long sizeIntArray(int array[]);
long sizeCharArray(char x[]);
long sizeDoubleArray(double x[]);
long sizeFloatArray(float x[]);

int* arrayIntcp(int x[]);
float* arrayFloatcp(float x[]);
double* arrayDoublecp(double x[]);

#endif