#include <iostream>
#include <math.h>
#include <stdlib.h>
using namespace std;
#define DEBUGLEVEL 1
#include "util.h"

void suffixArray(int* s, int* SA, int n, int K);

void printV(int* a, int n, char *comment) {
  cout << comment << ":";
  for (int i = 0;  i < n;  i++) {
    cout << a[i] << " " ;
  }
  cout << endl;
}

bool isPermutation(int *SA, int n) {
  bool *seen = new bool[n];
  for (int i = 0;  i < n;  i++) seen[i] = 0;
  for (int i = 0;  i < n;  i++) seen[SA[i]] = 1;
  for (int i = 0;  i < n;  i++) if (!seen[i]) return 0;
  return 1;
}

bool sleq(int *s1, int *s2) {
  if (s1[0] < s2[0]) return 1;
  if (s1[0] > s2[0]) return 0;
  return sleq(s1+1, s2+1);
} 

// is SA a sorted suffix array for s?
bool isSorted(int *SA, int *s, int n) {
  for (int i = 0;  i < n-1;  i++) {
    if (!sleq(s+SA[i], s+SA[i+1])) return 0;
  }
  return 1;  
}

// try all inbuts from {1,..,b}^n for 1 <= n <= nmax
int main(int argc, char **argv) {
  //int n = 13;
  //int s1[] = {2,1,4,4,1,4,4,1,3,3,1,0,0,0}; // mississippi
  //int s2[] = {0,0,0,0,0,0,0,0,0,0,0,0,0,0};
  //int n = 8;
  //int s1[] = {2,1,3,1,3,1,0,0,0}; // banana
  //int s2[] = {0,0,0,0,0,0,0,0,0};
  int nmax = atoi(argv[1]); 
  int b    = atoi(argv[2]);
  // try all strings from (1..b)^n
  for (int n = 2;  n <= nmax;  n++) {
    cout << n << endl;
    int N = int(pow(double(b),n) + 0.5);
    int* s = new int[n+3];
    int* SA = new int[n+3];
    for (int i = 0;  i < n;  i++) s[i] = SA[i] = 1;
    s[n] = s[n+1] = s[n+2] = SA[n] = SA[n+1] = SA[n+2] = 0;
    for (int j =0;  j < N;  j++) {
      Debug1(printV(s, n, "s"));
      suffixArray(s, SA, n, b);
      Assert0(s[n] == 0);
      Assert0(s[n+1] == 0);
      Assert0(SA[n] == 0);
      Assert0(SA[n+1] == 0);
      Assert0(isPermutation(SA, n));
      Assert0(isSorted(SA, s, n));
      Debug1(printV(SA, n, "SA"));
    
      // generate next s
      int i;
      for (i = 0;  s[i] == b;  i++) s[i] = 1;
      s[i]++;
    }
    delete [] s;
    delete [] SA;
  }
}
