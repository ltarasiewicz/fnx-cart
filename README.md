fnx.local
=========

A Symfony project created on August 7, 2015, 11:59 am.

##Implementacja koszyka zakupowego (frontend) w oparciu o natywny mechanizm zarządania sesją w Symfony 2.7##

**Kilka istotnych infomracji na temat aplikacji:**

1. Koszyk zakupowy zbudowany w oparciu o serwis sesji udostępniany we frameworku Symfony,
2. Mapowanie encji w relacji "ManyToOne" pomiędzy produktami a kategorią,
3. `Lib/Cart.php` - fasada/wrapper dla wbudowanego interfejsu sessji w SF,
4. Baza danych budowana w oparciu o klasy migracji (`app/DoctrineMigrations`)
5. Dane ładowane za pomocą 'fixtures' - DoctrineFixturesBundle (`src/AppBundle/DataFixtures`)
6. Zależności front-endowe zarządane przez Bower (opisane w `bower.json`)
7. Bootstrap oraz własne style kompilowane z Sass za pomocą Gulp'a (`gulpfile.js`)

**Instrukcja instalacji:**

Po sklonowaniu repozytorium do ścieżki root'a serwera, z którego 'podawana' będzie strona należy przejść do tego folderu, a następnie:

1. Uzupełnić plik parameters.yml (jeżeli nie istnieje należy go utworzyć) parametrami bazy danych, z której aplikacja będzie korzystała (database_host, database_name, database_password, etc.);
2. Zainstalować wszystki zależności zdefiniwane w composer.json - komenda 'composer install';
3. W ścieżce root strony na serwerze należy wykonać komendy: 
- '`php app/console doctrine:database:create`', która stworzy bazę danych na podstawie parametrów z parameters.yml;
- '`php app/console doctrine:migrations:migrate`' celem stworzenia struktury bazy danych opisanej w klasiach migracji;
- '`php app/console doctrine:fixtures:load`' celem wczytanie danych do stworzonej wcześniej bazy danych
 
**Aplikacja dosępna live na Heroku:**

http://fnx-cart.herokuapp.com/
