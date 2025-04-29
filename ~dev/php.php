<?php

function greet($name, $title = 'Mr./Ms.', $punctuation = '!') {
    echo "Hello, $title $name$punctuation";
}

// You can skip the middle argument (title)
greet(name: 'Alice', punctuation: '.');
// Output: Hello, Mr./Ms. Alice.
