# E-Clothing

Pylypets Ihor

5ZYI35

## Stručný opis projektu
Cieľom môjho projektu je vytvoriť internetový obchod s oblečením, ktorý umožní pohodlný a efektívny predaj produktov. Dôraz kladiem na intuitívne a prehľadné používateľské rozhranie, ktoré bude jednoduché na používanie pre zákazníkov aj predajcov.
Mojím zámerom je čo najviac zjednodušiť proces pridávania nových produktov a zároveň umožniť zadávanie všetkých potrebných informácií. Chcem vytvoriť systém, ktorý bude natoľko intuitívny, že aj používatelia bez predchádzajúcich skúseností so správou webových stránok budú môcť samostatne a bez problémov spravovať celý internetový obchod.
Rozhodol som sa realizovať práve tento projekt, pretože moja mama má malý obchod s oblečením a myslím si, že by bolo skvelé vytvoriť pre jej podnik vlastnú webovú stránku. 
## Role v projekte
1. Návštevník
Môže prezerať produkty, fotografie, popisy a ceny. Môže vyhľadávať a filtrovať produkty.

2. Registrovaný používateľ (zákazník)
Môže spravovať svoj účet, vytvárať objednávky a sledovať ich stav.

3. Pracovník zákazníckej podpory
Pomáha zákazníkom, poskytuje informácie o produktoch a rieši problémy s objednávkami.

4. Administrátor
Spravuje produkty, ceny, fotografie, skladové zásoby, objednávky a nastavenia obchodu.

## Prípady použitia podľa rolí
Prípady použitia
1. Návštevník
Prezrie si ponuku oblečenia.
Vyhľadá a filtruje produkty.
Zobrazí si detail produktu.
2. Registrovaný používateľ (zákazník)

Zaregistruje sa a prihlási sa.
Pridá produkty do nákupného košíka.
Vytvorí objednávku.
Sleduje stav objednávky.

3. Pracovník zákazníckej podpory
Prezrie si objednávky zákazníkov.
Poskytne informácie o produktoch.
Pomôže vyriešiť problémy s objednávkami.

4. Administrátor
Pridá nový produkt.
Upraví alebo odstráni existujúci produkt.
Aktualizuje ceny a skladové zásoby.
Spravuje objednávky zákazníkov.

## Plánované entity
Hlavné dátové entity aplikácie

1. Používateľ (User)
Slúži na evidenciu zákazníkov a administrátorov.
Atribúty: ID, meno, priezvisko, e-mail, heslo, rola.
Vzťahy: Používateľ môže vytvoriť viacero objednávok.

2. Produkt (Product)
Predstavuje oblečenie dostupné v obchode.
Atribúty: ID, názov, popis, cena, fotografia, veľkosť, farba, skladové množstvo.
Vzťahy: Produkt môže byť súčasťou viacerých objednávok.

3. Objednávka (Order)
Uchováva informácie o nákupe zákazníka.
Atribúty: ID, dátum vytvorenia, stav, celková cena, doručovacia adresa.
Vzťahy: Objednávka patrí jednému používateľovi a obsahuje jeden alebo viac produktov.

4. Položka objednávky (OrderItem)
Predstavuje konkrétny produkt v objednávke.
Atribúty: ID, ID objednávky, ID produktu, množstvo, cena za kus.
Vzťahy: Patrí jednej objednávke a odkazuje na jeden produkt.

5. Kategória (Category)
Slúži na rozdelenie produktov do kategórií, napríklad tričká, nohavice alebo bundy.
Atribúty: ID, názov, popis.
Vzťahy: Jedna kategória môže obsahovať viacero produktov.

## Vzťahy medzi entitami
Vzťahy medzi entitami

Používateľ – Objednávka (1): Jeden používateľ môže vytvoriť viacero objednávok, ale každá objednávka patrí jednému používateľovi.
Objednávka – Položka objednávky (1): Jedna objednávka obsahuje jednu alebo viac položiek.
Produkt – Položka objednávky (1): Jeden produkt môže byť súčasťou viacerých položiek objednávok.
Kategória – Produkt (1): Jedna kategória môže obsahovať viacero produktov, pričom každý produkt patrí do jednej kategórie.
Vzťah medzi entitami Objednávka a Produkt je M, pretože objednávka môže obsahovať viacero produktov a jeden produkt môže byť súčasťou viacerých objednávok. Tento vzťah je realizovaný prostredníctvom entity Položka objednávky.

## Hlavné stránky aplikácie
Hlavné stránky aplikácie

Domovská stránka
Zobrazuje hlavné kategórie oblečenia, odporúčané produkty a aktuálne ponuky.

Detail produktu
Zobrazuje fotografie produktu, jeho popis, cenu, dostupné veľkosti a skladovú dostupnosť.

Nákupný košík
Zobrazuje vybrané produkty, umožňuje meniť ich množstvo a vypočítať celkovú cenu nákupu.

Objednávka
Umožňuje zadať doručovacie údaje, skontrolovať objednávku a potvrdiť nákup.

Používateľský účet
Umožňuje registráciu, prihlásenie, úpravu osobných údajov a prezeranie histórie objednávok.

Administrátorský panel
Umožňuje spravovať produkty, fotografie, ceny, skladové zásoby a objednávky.

Zákaznícka podpora
Poskytuje kontaktné informácie a možnosť kontaktovať podporu pri problémoch s nákupom alebo objednávkou.

## Rozdelenie funkcionality
Základné funkcie
Zobrazenie a vyhľadávanie produktov.
Filtrovanie produktov podľa kategórie, ceny a veľkosti.
Zobrazenie detailu produktu vrátane fotografií a popisu.
Pridávanie, úprava a odstraňovanie produktov administrátorom.
Nákupný košík a vytvorenie objednávky.
Registrácia a prihlásenie používateľov.
Správa objednávok a skladových zásob.
Zákaznícka podpora prostredníctvom kontaktného formulára.

Rozširujúce funkcie
Zoznam obľúbených produktov.
Hodnotenie a recenzie produktov.
Platba online.
Automatické e-mailové potvrdenia objednávok.
Pokročilé filtrovanie a triedenie produktov.
Zľavové kupóny a akciové ponuky.
Prehľad štatistík predaja pre administrátora.
