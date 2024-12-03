# Website Event Management Menggunakan PostgreSQL
Kami membuat sebuah web dan basis data event management dengan ERD seperti berikut

<img src="https://github.com/user-attachments/assets/56997045-b770-44c6-9407-992ea06b2d98" alt="ERD Event Management" width="900">

*Note*
* : Primary Key
** : Foreign Key

Kardinalitas antar tabel : 
1. user ke event (1 ke N) : Satu pengguna sebagai penyelenggara (organizer) dapat membuat banyak event. 
2. user ke event registration (1 ke N) : Satu pengguna dapat mendaftar di banyak acara
3. event ke evenRegistration (1 ke N) : Satu acara dapat memiliki banyak peserta yang terdaftar
 
