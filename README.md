# Fjfi-pvs-inzeraty

## Jak rozchodit projekt

- Krok 1. Stáhnout a nainstalovat server s db, napr. http://www.easyphp.org/easyphp-devserver.php (ja osobně používám EASYPHP DEVSERVER 14.1 VC9).
- Krok 2. Po instalaci do vas_instal_adresar/EasyPHP-DevServer-14.1VC9/data/localweb/ nakopírujte projekt z GitHubu, popřípadě si v něm vytvořte novou složku s názvem projektu a do ní si projekt nakopírujte (pokud budete chtít mít více projektů, na funkčnost to nemá vliv).
- Krok 3. Ve vas_instal_adresar/EasyPHP-DevServer-14.1VC9/ spustit EasyPHP-DevServer-14.1VC9.exe
- Krok 4. Dole vpravo se v liště objeví ikona EasyPHP, kliknutím na ní vyskočí okýnko, ve kterém zkontrolujte, že kontrolky Apache a MySQL svítí zeleně a jsou "Started".
- Krok 5. Spusťte libovolný internetový prohlížeč a zadejte adresu localhostu (http://127.0.0.1/), popřípadě klikněte na šedivou část okýnka s kontrolkami a vyberte možnost "Local Web".
- Krok 6. v prohlížeči se proklikejte do vašeho projektu a v něm klikněte na složku "www" a webová stránka se spustí.
 
## Pro Mac OS
- Krok 1. Stahnout/nainstalovat MAMP https://www.mamp.info/en/
- Krok 2. Rozbehnout (Vyresit mozne nesrovnalosti v portech)
- Krok 3. Vyklonovat git repo do /Applications/MAMP/htdocs
```
    cd /Applications/MAMP/htdocs && git clone git@github.com:jandoubek/fjfi-pvs-inzeraty.git
```

Projekt by mel byt umisten zde http://localhost:8887/fjfi-pvs-inzeraty/www/ . 8887 je port ktery si nastavujete pro webserver.

## Propojení lokálního adresáře s adresářem na GitHub - návod od pribyto4
- Krok 1. Stáhnout GitHub Desktop z https://desktop.github.com/ a nainstalovat ho
- Krok 2. Spustit GitHub Desktop a vyplnit uživatelské jméno a heslo
- Krok 3. V GitHub Desktop najít adresář, který je na webu a dat klonovat

Po úpravách souborů a commitu (nutno vyplnit Summary a Description) stačí kliknout na Sync
