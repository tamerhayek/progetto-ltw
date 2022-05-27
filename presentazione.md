# DESCRIZIONE
La nostra applicazione riprende il famoso gioco Trivia Crack, basato su quiz con domande di cultura generale. La particolarità del nostro gioco è l'uso di domande di ambito informatico.

# NAVBAR
Per iniziare mostriamo la Navbar, presente in tutte le pagine, contenente dei link per le pagine principali del nostro sito. In alto a destra abbiamo la sezione Utente. In caso di utente non loggato, vengono mostrati i link all'accesso e alla registrazione. Altrimenti, verrebbe mostrato lo username con un link alla pagina del profilo utente e il pulsante per il logout. Tutto questo realizzato tramite un controllo dei cookies in PHP.

# HOMEPAGE
Durante lo scroll verticale, una volta raggiunte determinate zone della pagina si possono notare queste piccole animazioni realizzate tramite una libreria Javascript chiamata ScrollReveal. Come poi si vedrà, è presente in molte altre pagine della nostra app.
Abbiamo optato di non inserire i contatti nel footer ma di creare una pagina separata raggiungibile dalla navbar.

# CONTATTI
La pagina dei contatti è semplice, contente telefono, email e indirizzo.
Come si può notare, in qualsiasi pagina si vada non viene mostrato il nome del file nell'URL ma semplicemente il nome della cartella in cui risiede il file. Questo perché abbiamo organizzato i file in cartelle apposite contenti un index.php che sarà omesso nei reindirizzamenti.
Poi c'è anche la cartella src contenente le risorse generali: immagini, audio e un file css generale.
Inoltre abbiamo inserito il logo del nostro sito come icona della tab che esce accanto al titolo della pagina.

# REGISTRAZIONE
Per riprendere sempre l'ambito informatico, abbiamo creato, per login e registrazione, un'interfaccia stile terminale.


- Nella versione Desktop, dov'è possibile premere invio da tastiera, abbiamo creato delle funzioni che catturino l'evento legato al tasto invio: in caso non ci siano errori viene aggiornata la form, settando come readonly il dato appena inserito e rendendo visibile il campo successivo per l'inserimento del prossimo dato. In caso di errore invece, verrà stampato in rosso sotto al campo corrente della form, il corrispondente messaggio di errore, impedendo all'utente di inserire il prossimo dato finché non si inserirà un input valido. 
Dopo aver inserito l'ultimo input, confermata la sua validità, viene reso visibile un bottone di tipo submit che inizialmente è nascosto e disabilitato, che viene cliccato tramite JQuery. Successivamente avviene quindi la submit che fa un controllo generale dei dati inseriti e poi indirizza verso il file registrati.php che controlla nel database che non ci sia un altro utente con lo stesso username. In caso di successo, viene presentata una pagina di benvenuto con un link alla pagina di accesso. In caso di errore, viene ricaricata la pagina della registrazione comunicando all'inizio del terminale che esiste già un utente con lo stesso username. Questo viene realizzato passando un parametro alla GET.
*Prova registrazione con successo*

- Nella versione Mobile e Tablet invece, potendo esserci problemi riguardo la gestione della cattura del tasto invio, abbiamo aggiunto dei bottoni che, nella versione Desktop sono nascosti, mentre sono resi visibili tramite mediaQuery negli schermi di larghezza inferiore ai 1200px. Questi bottoni faranno esattamente la stessa azione spiegata precedentemente per il tasto invio.
*Prova registrazione utente già esistente*

# LOGIN
Il funzionamento del login è praticamente identico a quello della registrazione, con la sola differenza che gli unici input richiesti sono lo username e la password. Il controllo effettuato qui è quello dell'esistenza nel database di un utente con lo username la password inseriti.
*Prova login errato*
*Prova login successo*

Come si può vedere la sezione Utente della Navbar è cambiata: non vengono più mostrati i link all'accesso e alla registrazione ma viene mostrato lo username e il pulsante di logout. Dopo mostreremo il funzionamento del logout.

# PROFILO UTENTE
Cliccando sullo Username della Navbar, verremo indirizzati alla pagine del profilo utente contente i dati personali con il numero delle sfide giocate e di quelle vinte.

# SFIDE
Andando nella pagina 'Sfide', vedremo che inizialmente la pagina presenza solo i pulsanti per iniziare a giocare in quanto l'utente è stato appena creato e non ha iniziato nessuna sfida. 

Un utente può partecipare ad una sola sfida per volta con lo stesso avversario: se c'è una sfida già iniziata con un utente, nessuno dei due potrà risfidare l'altro finché la partita non sarà terminata, cioè nel momento in cui entrambi avranno giocato.


Passiamo subito all'avvio di una sfida, che può iniziare in 3 modi:
- pulsante "Inizia una nuova sfida casuale!" che estrae randomicamente un utente diverso da se stessi dal database e inizia una sfida.

Come si può vedere, una sfida, appena avviata, fa giocare subito l'utente che la crea e consiste nel rispondere a 5 domande prese casualmente dal database avendo a disposizione un tempo limitato di 3 minuti, scaduto il quale la sfida viene automaticamente terminata nel punto in cui si era rimasti. Notiamo che viene passato l'id della sfida come parametro GET per permettere di sapere in qualsiasi momento di quale sfida si stia parlando in modo tale che le azioni da intraprendere si basino sulla sfida corretta e per rendere più semplice raggiungere questa pagina in maniera più dinamica.

Proviamo a rispondere alle domande. Al click della risposta, verrà eseguita una richiesta AJAX di tipo POST per ottenere dal database la risposta corretta necessaria ai controlli ed eventualmente aumentare di uno il punteggio del giocatore. In caso di risposta corretta, il bottone corrispondente verrà colorato di verde e sarà emesso il corrispondente suono. In caso di risposta errata il bottone verrà colorato di rosso, quello della risposta giusta verrà colorato di verde e sarà emesso il corrispondente suono di errore. Dopo aver risposto alla domanda, verrà abilitato il bottone per passare alla prossima domanda che effettuerà una richiesta AJAX di tipo POST al database per ottenere la prossima domanda che sarà caricata dinamicamente nelle rispettive zone e farà avanzare la barra di progresso cambiando il colore, avvicinandolo verso il verde.

*gioca una sfida completa*
Al termine delle domande sarà abilitato il pulsante 'Mostra risultati' per visualizzare l'esito della sfida appena giocata ed eventualmente lo storico delle sfide precedenti concluse con lo stesso giocatore. La pressione di questo pulsante effettua una POST su un file php che termina la sfida e aggiorna il vincitore della sfida.
In caso di parità segnerà la scritta "Pareggio".


- pulsante "Sfida un tuo amico" che ti permette di cercare uno username tramite l'apposito input e sfidarlo in caso di utente trovato; altrimenti compare un errore che segnala che l'utente cercato non esiste nel database
*cerca utente non esistente*
*cerca utente esistente ed esci dal gioco*
Quanto si clicca sulla X per uscire viene effettuata una POST sullo stesso file citato prima per concludere la sfida e reindirizzare l'utente sulla pagina delle sfide.


- pulsante "+" dell'homepage che inizia una sfida casuale direttamente da lì senza passare per la pagina delle sfide
Teniamo conto dello status dei due giocatori durante la sfida per sapere quando una partita è terminata. Quindi, per evitare ricaricamenti della pagina con cambiamenti delle domande all'infinito, all'inizio della partita viene settato lo status del giocatore corrente a true, per indicare che il giocatore ha giocato o sta giocando indipendentemente se risponderà a tutte le domande oppure no. Abbiamo perciò messo, all'inizio di ogni sfida un controllo php che verifica che lo status di quell'utente nella sfida non sia settato a true: in quel caso reindirizza l'utente direttamente alla pagina dei risultati.
*gioca sfida e refresha*

# CLASSIFICA
*aggiungi*
La pagina della classifica mostra i giocatori migliori insieme al numero di sfide vinte.

# LOGOUT
Nel caso in cui l'utente sia loggato, nella sezione Utente della navbar compare il collegamento al profilo utente e il pulsante di logout. Alla pressione di questo pulsante, verrà passato un parametro alla GET che, tramite uno script php, permetterà di cancellare il cookie tramite cui l'utente veniva memorizzato precedentemente e di ritornare all'home page, facendo ricomparire nella sezione Utente della Navbar i collegamenti per accesso e registrazione.

# ADMIN
Gli account di noi due sono registrati come admin, il che ci permette, dal profilo utente, di andare in una sezione riservata dove possiamo visualizzare gli utenti, le sfide e le domande della nostra applicazione. Il caricamento di queste informazioni avviene all'interno della stessa pagina in modo dinamico attraverso AJAX: viene fatta una richiesta al server e quando questo fornirà la risorsa, verrà eseguita una funzione gestore che caricherà la risorsa ricevuta nell'apposito div.

