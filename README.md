Proiectul este scris in cod PHP nativ folosind cateva librarii uzuale, anume (PHPUnit, dotenv, PHProuter).

Arhitectura este de tip MVC (fara partea de views conform cerintelor proiectului).

Dependintele proiectului sunt gestionate de composer.

<B> Documentatia API-ului (cele cateva endpoint-uri implementate) se pot gasi in folderul /doc. <br/>
Este generata prin "apidoc" si se poate vizualiza in format HTML stilizat </B>
<br/><br/>
Mai jos voi explica cateva detalii principale ale implementarii, pentru orice alte modificari sau eventuale intrebari nu ezitati sa ma contactati.
<br/>
<br/>
Pentru a rula proiectul aveti nevoie de:
* Baza de date MySQL / MariaDB
* PHP 7.3 
* Pentru a rula folositi comanda: 
<br/>
<code>
php -s 127.0.0.1:8000
</code>


<br/>
Explicarea structurii: 
<br/>
In folderul src se gaseste tot codul dupa cum urmeaza:<br/>
* In /Controllers se afla Factory-urile si Handler-ele necesare rutarii si bazei de date<br/>
* In /DatabaseMigrations se afla migrarile responsabile de creearea tabelelor asigurand portabilitatea aplicatiei<br/>
* In /Models se afla implementarile obiectelor necesare jocului<br/>
* In /Routes se afla rutele (folosite in API) pentru fiecare model<br/>

In folderul tests se gasesc testele unitare pentru fiecare model (este doar o implementare succinta care verifica doar statusCode pentru a preveni internal server error ), implementate prin PHPUnit. <br/>


In fisierul config.php se efectueaza conexiunea la baza de date si includ toate fisierele necesare.


In cazul in care se doreste o simulare rapida a unei batalii in consola (sau intr-o pagina de browser) puteti folosi fisierul "SimulateBattle.php".
<br/>
Includerea acestora se poate face cel mai simplu prin decomentarea liniei aferente in fisierul "index.php".

