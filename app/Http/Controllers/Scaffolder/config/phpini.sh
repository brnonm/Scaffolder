#!/usr/bin/env bash

max_input_vars=10000

for key in max_input_vars
do
 sed -i "s/^\($key\).*/\1 $(eval echo = \${$key})/" php.ini
done
