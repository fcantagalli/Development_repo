/*
Felipe Tozato Cantagalli
Description: file just to train and test array in C
*/

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "array.h"
#define TRUE 0;
#define FALSE 1; 

int main(){
	int array[10]  = {1,2,3,4,5,6,7,8,9,10};

	printf("%lu ",sizeof(array));
	printf("%lu ",sizeof(int));
	return 0;
}

void printIntArray(int x[]) {
	long size = sizeIntArray(x);
	int i;
	for(i = 0; i < size; i++){
		printf("%d ",x[i]);
	}
	printf("\n");
}	
void printCharArray(char x[]){
	long size = sizeCharArray(x);
	int i;
	for(i = 0; i < size; i++){
		printf("%c ",x[i]);
	}
}
void printDoubleArray(double x[]){
	long size = sizeDoubleArray(x);
	int i;
	for(i = 0; i < size; i++){
		printf("%f", x[i]);
	}
	printf("\n");
}
void printFloatArray(float x[]){
	long size = sizeFloatArray(x);
	int i;
	for(i = 0; i < size; i++){
		printf("%f", x[i]);
	}
	printf("\n");
}

int* arrayIntcp(int x[]){
	long size = sizeIntArray(x);

	int* new;// = (int*) malloc(((int)size)*int);
	int i;
	for(i = 0; i < size; i++){
		new[i] = x[i];
	}
	return new;
}

float* arrayFloatcp(float x[]){
	long size = sizeFloatArray(x);

	float* new; //= (float*) malloc(size*float);
	int i;
	for(i = 0; i < size; i++){
		new[i] = x[i];
	}
	return new;
}

double* arrayDoublecp(double x[]){
	long size = sizeDoubleArray(x);

	double* new;// = (double*) malloc(size*double);
	int i;
	for(i = 0; i < size; i++){
		new[i] = x[i];
	}
	return new;
}

long sizeIntArray(int array[]){
	return sizeof(array)/sizeof(long);
}
long sizeCharArray(char x[]){
	return sizeof(x)/sizeof(char);
}
long sizeDoubleArray(double x[]){
	return sizeof(x)/sizeof(double);
}
long sizeFloatArray(float x[]){
	return sizeof(x)/sizeof(float);
}