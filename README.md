PHP Lab1
===========


#####Τι είναι PHP

  - Server Scripting Γλώσσα Προγραμματισμού
  - Ισχυρό εργαλείο για την κατασκευή δυναμικών και δια δραστικών σελίδων Παγκοσμίου Ιστού.
  - Ευρέως διαδεδομένη.
  -Είναι εντελώς δωρεάν.

#####PHP Αρχείο

- Μπορεί να περιέχει απλό κείμενο, HTML, CSS, JavaScript και κώδικα PHP
- Τα αρχεία PHP εκτελούνται στον διακομιστή (Server) και το αποτέλεσμα αυτών επιστρέφεται στον περιηγητή ιστού (Browser) ως απλό HTML κείμενο.
- Κατάληξη αρχείων  .php

#####Γιατί PHP?

- Μπορεί να τρέξει σε μια πληθώρα από πλατφόρμες (Linux, Unix, Windows, Mac OS X etc.)
- Είναι συμβατή με τους περισσότερους τύπους διακομιστών (Servers) που χρησιμοποιούνται σήμερα (Apache, IIS, etc.)
- Υποστηρίζει ένα ευρύ φάσμα βάσεων δεδομένων
- Εύκολη στην εκμάθηση 

#####Setup PHP

- Εγκατάσταση Xampp (https://www.apachefriends.org/index.html)
- Ξεκινάμε τον Apache και MySQL (Προσοχή: κλείστε το Skype)
- Πρόσβαση στο http://localhost/


> Αν δεν τρέχει ο Apache αλλάξτε την πόρτα του skype.


#Παραδείγματα

 Εμφάνιση κειμένου στο body της σελίδας με χρήση  PHP



```php
<!DOCTYPE html>
<html>
    <body>
        <?php
            echo "My first PHP script!";
        ?>
    </body>
</html> 
```

 Ορισμός μεταβλητών



```php
<?php
    $txt = "Hello world!";
    $x = 5;
    $y = 10.5;
?>
```

Εμφάνιση Κειμένου



```php
<?php
    echo "<h2>PHP is Fun!</h2>";
    echo "Hello world!<br>";
    echo "I'm about to learn PHP!<br>";
    echo "This ", "string ", "was ", "made ", "with multiple parameters.";
?> 
```
Εμφάνιση Μεταβλητών



```php
<?php
    $txt1 = "Learn PHP";
    $txt2 = "W3Schools.com";
    $x = 5;
    $y = 4;

    echo "<h2>$txt1</h2>";
    echo "Study PHP at $txt2<br>";
    echo $x + $y;
?> 
```

Συνθήκες ελέγχου

```php
<?php
    $t = date("H");

    if ($t < "20") {
        echo "Have a good day!";
    } else {
        echo "Have a good night!";
    }
?>  
```

Δομή Επανάληψης
```php
<?php
    $x = 1;

    while($x <= 5) {
        echo "The number is: $x <br>";
        $x++;
    }
?> 
```

Δομή με For

```php
<?php
    for ($x = 0; $x <= 10; $x++) {
        echo "The number is: $x <br>";
    }
?> 
```

Συναρτήσεις 

```php
<?php
    function writeMsg() {
        return "Hello world!";
    }
    $message = writeMsg(); // call the function
    echo $message;
?>
```
Πίνακες

```php
<?php
    $cars = array("Volvo", "BMW", "Toyota");
    echo "I like " . $cars[0] . ", " . $cars[1] . " and " . $cars[2] . ".";
?> 
```
### Επόμενο Εργαστήριο

 - Δημιουγία Φόρμας
