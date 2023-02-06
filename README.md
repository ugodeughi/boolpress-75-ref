

## REGOLE PER INSTALLAZIONE VUE JS 3 

Al termine della configurazione base lanciare:

npm install vue@next <br>
npm i @vitejs/plugin-vue (se necessario --force)  <br>
npm install vue-router@4  <br>

Curare l'impostazione in vite.config.js per la configurazione del plugin e per la gestione delle risorse

## FEATURES DI QUESTA VERSIONE

## Lato Backend
- CRUD
- gestione multi utente dei post
- seeder che genera  100 post, relazioni random fra fra tag<->post, category<->post e users<->post
- piccolo motore di ricerca 
- possibilità di ordinare l'elenco dei post per id, titolo o data in maniera crescente o decrescente
- paginazione
- pagina elenco post per categoria
- pagina elenco post per tag
- CRUD categorie e tag
- utilizzo di un partial per il form del delete con passaggio di parametri

## Lato Frontend
- VueJs installato all'interno del progetto
- paginazione basata sulla stampa dei link forniti dall'API
- piccolo motore di ricerca tramite API
- filtro dei post per categoria o tag
- invio del form dei contatti con validazione tramite API
- transition al cambio pagina con la libreria animate.css

## note
- lanciare le migrazioni
- prima di lanciare i seeder creare almeno 2 utenti
- lanciare <code>php artisan db:seed</code> 
