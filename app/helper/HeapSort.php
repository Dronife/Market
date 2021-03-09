<?php

namespace app\helper;

class HeapSort
{
    public function sort(&$collection, $n)
    {

        for ($i = (int)($n / 2); $i >= 0; $i--) {
            HeapSort::heapify($collection, $n - 1, $i);
        }
        for($i = $n - 1; $i >= 0; $i--) {
            //swap last element of the max-heap with the first element
            $temp = $collection[$i];
            $collection[$i] = $collection[0];
            $collection[0] = $temp;
        
            //exclude the last element from the heap and rebuild the heap 
            HeapSort::heapify($collection, $i-1, 0);
          }
    }


    private function heapify(&$collection, $n, $i)
    {
        $max = $i;
        $left = 2 * $i + 1;
        $right = 2 * $i + 2;

        if ($left <= $n && $collection[$left]->price > $collection[$max]->price) {
            $max = $left;
        }

        //if the right element is greater than root
        if ($right <= $n && $collection[$right]->price > $collection[$max]->price) {
            $max = $right;
        }

        if($max != $i) {
            $temp = $collection[$i];
            $collection[$i] = $collection[$max];
            $collection[$max] = $temp;
            //Recursively heapify the affected sub-tree
            HeapSort::heapify($collection, $n, $max); 
          }
    }
}
