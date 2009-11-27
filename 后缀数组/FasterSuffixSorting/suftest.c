/* suftest.c
   Copyright N. Jesper Larsson 1999.
   
   Program to test suffix sorting function. Reads a sequence of bytes from a
   file and calls suffixsort. This is the program used in the experiments in
   "Faster Suffix Sorting" by N. Jesper Larsson (jesper@cs.lth.se) and Kunihiko
   Sadakane (sada@is.s.u-tokyo.ac.jp) to time the suffixsort function in the
   file qsufsort.c.

   This software may be used freely for any purpose. However, when distributed,
   the original source must be clearly stated, and, when the source code is
   distributed, the copyright notice must be retained and any alterations in
   the code must be clearly marked. No warranty is given regarding the quality
   of this software.

   CHANGES:
   
   1999-06-14: Fixed preprocessor conditions so that it's possible to have
   CHECK==0 and PRINT==2 simultaneously. Added to comment about PRINT==2.*/

#include <stdlib.h>
#include <stdio.h>
#include <limits.h>

#ifndef CHECK
/* Nonzero CHECK means check that sort is correct. Very slow for repetitive
   files.*/
#define CHECK 0
#endif

#ifndef PRINT
/* 0 for no printing. 1 to print suffix numbers in sorted order. 2 to print
   first MAXPRINT characters of each suffix in sorted order (makes sense only
   if the input is text and COMPACT is 0).*/
#define PRINT 0
#endif
#ifndef MAXPRINT
#define MAXPRINT 10
#endif

#ifndef COMPACT
/* 0 to use alphabet 0...UCHAR_MAX without checking what appears. 1 to limit
   the alphabet to the range l...k-1 that actually appears in the input. 2 to
   transform the alphabet into 1...k-1 with no gaps and minimum k, preserving
   the order.*/
#define COMPACT 1
#endif

#define MIN(a, b) ((a)<=(b) ? (a) : (b))

void suffixsort(int *x, int *p, int n, int k, int l);

int scmp3(unsigned char *p, unsigned char *q, int *l, int maxl)
{
   int i;
   i = 0;
   while (maxl>0 && *p==*q) {
      p++; q++; i++;
      maxl--;
   }
   *l = i;
   if (maxl>0) return *p-*q;
   return q-p;
}

int main(int argc, char *argv[])
{
   int c, i, j, *x, *p, *pi;
   int n, k, l;
#if COMPACT==2
   unsigned char q[UCHAR_MAX+1];
#endif
#if CHECK || PRINT==2
   unsigned char *s;
#endif
   char *fnam;
   FILE *f;

   if (argc!=2) {
      fprintf(stderr, "syntax: suftest file\n");
      return 1;
   }
   fnam=argv[1];
   if (! (f=fopen(fnam, "rb"))) {
      perror(fnam);
      return 1;
   }
   if (fseek(f, 0L, SEEK_END)) {
      perror(fnam);
      return 1;
   }
   n=ftell(f);
   if (n==0) {
      fprintf(stderr, "%s: file empty\n", fnam);
      return 0;
   }
   p=malloc((n+1)*sizeof *p);
   x=malloc((n+1)*sizeof *x);
   if (! p || ! x) {
      fprintf(stderr, "malloc failed\n");
      return 1;
   }

#if COMPACT==1
   l=UCHAR_MAX;
   k=1;
   for (rewind(f), pi=x; pi<x+n; ++pi) {
      *pi=c=getc(f);
      if (c<l)
         l=c;
      if (c>=k)
         k=c+1;
   }
#else
   for (rewind(f), pi=x; pi<x+n; ++pi)
      *pi=getc(f);
#if COMPACT==0
   l=0;
   k=UCHAR_MAX+1;
#elif COMPACT==2
   for (i=0; i<=UCHAR_MAX; ++i)
      q[i]=0;
   for (pi=x; pi<x+n; ++pi)
      q[*pi]=1;
   for (i=k=0; i<=UCHAR_MAX; ++i)
      if (q[i])
         q[i]=k++;
   for (pi=x; pi<x+n; ++pi)
      *pi=q[*pi]+1;
   l=1;
   ++k;
#endif
#endif
   if (ferror(f)) {
      perror(fnam);
      return 1;
   }
#if CHECK || PRINT==2
   s=malloc(n * sizeof *s);
   if (! s) {
      fprintf(stderr, "malloc failed\n");
      return 1;
   }
   for (i=0; i<n; ++i)
      s[i]=(unsigned char) (x[i]-l);
#endif
   
   suffixsort(x, p, n, k, l);
   
#if CHECK

   fprintf(stderr, "checking...\n");
   for (i=0; i<n; ++i) {
      if (scmp3(s+p[i], s+p[i+1], & j, MIN(n-p[i], n-p[i+1]))>=0)
         fprintf(stderr, "i %d p[i] %d p[i+1] %d\n", i, p[i], p[i+1]);
   }
   fprintf(stderr, "done.\n");
   
#endif
   
#if PRINT
   
   for (i=0; i<=n; ++i) {
#if PRINT==1
      printf("%d\n", p[i]);
#else
      printf("%3d \"", p[i]);
      for (j=p[i]; j<n && j-p[i]<MAXPRINT; ++j)
         switch(c=s[j]) {
         case '\n':
            printf("\\n");
            break;
         case '\t':
            printf("\\t");
            break;
         default:
            putchar(c);
         }
      printf("\"\n");
#endif
   }

#endif
   
   return 0;
}
