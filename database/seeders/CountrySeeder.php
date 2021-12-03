<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::insert($this->countriesArray());
    }

    private function countriesArray()
    {
        $now = now();

        return [
            ['code' => 'LC', 'name' => 'Αγία Λουκία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BL', 'name' => 'Άγιος Βαρθολομαίος', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MF', 'name' => 'Άγιος Μαρτίνος (Γαλλία)', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SX', 'name' => 'Άγιος Μαρτίνος (Ολλανδία)', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'VC', 'name' => 'Άγιος Βικέντιος και Γρεναδίνες', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SM', 'name' => 'Άγιος Μαρίνος', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PM', 'name' => 'Σαιν Πιερ και Μικελόν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KN', 'name' => 'Άγιος Χριστόφορος και Νέβις', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AZ', 'name' => 'Αζερμπαϊτζάν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'EG', 'name' => 'Αίγυπτος', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ET', 'name' => 'Αιθιοπία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'HT', 'name' => 'Αϊτή', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CI', 'name' => 'Ακτή Ελεφαντοστού', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AL', 'name' => 'Αλβανία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'DZ', 'name' => 'Αλγερία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AS', 'name' => 'Αμερικανική Σαμόα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TL', 'name' => 'Ανατολικό Τιμόρ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AO', 'name' => 'Ανγκόλα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AI', 'name' => 'Ανγκουίλα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AD', 'name' => 'Ανδόρρα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AQ', 'name' => 'Ανταρκτική', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AG', 'name' => 'Αντίγκουα και Μπαρμπούντα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AR', 'name' => 'Αργεντινή', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AM', 'name' => 'Αρμενία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AW', 'name' => 'Αρούμπα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AU', 'name' => 'Αυστραλία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AT', 'name' => 'Αυστρία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AF', 'name' => 'Αφγανιστάν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'VU', 'name' => 'Βανουάτου', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'VA', 'name' => 'Βατικανό', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BE', 'name' => 'Βέλγιο', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'VE', 'name' => 'Βενεζουέλα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BM', 'name' => 'Βερμούδες', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'VN', 'name' => 'Βιετνάμ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BO', 'name' => 'Βολιβία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KP', 'name' => 'Βόρεια Κορέα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BA', 'name' => 'Βοσνία-Ερζεγοβίνη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BG', 'name' => 'Βουλγαρία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BR', 'name' => 'Βραζιλία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'IO', 'name' => 'Βρετανικό Έδαφος Ινδικού Ωκεανού', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'VG', 'name' => 'Βρετανικές Παρθένοι Νήσοι', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'FR', 'name' => 'Γαλλία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TF', 'name' => 'Γαλλικά Νότια και Ανταρκτικά Εδάφη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GF', 'name' => 'Γαλλική Γουιάνα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PF', 'name' => 'Γαλλική Πολυνησία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'DE', 'name' => 'Γερμανία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GE', 'name' => 'Γεωργία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GI', 'name' => 'Γιβραλτάρ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GM', 'name' => 'Γκάμπια', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GA', 'name' => 'Γκαμπόν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GH', 'name' => 'Γκάνα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GG', 'name' => 'Γκέρνσεϊ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GU', 'name' => 'Γκουάμ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GP', 'name' => 'Γουαδελούπη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GT', 'name' => 'Γουατεμάλα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GY', 'name' => 'Γουιάνα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GN', 'name' => 'Γουινέα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GW', 'name' => 'Γουινέα-Μπισσάου', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GD', 'name' => 'Γρενάδα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GL', 'name' => 'Γροιλανδία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'DK', 'name' => 'Δανία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'DO', 'name' => 'Δομινικανή Δημοκρατία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PS', 'name' => 'Δυτική Όχθη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'EH', 'name' => 'Δυτική Σαχάρα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SV', 'name' => 'Ελ Σαλβαδόρ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CH', 'name' => 'Ελβετία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GR', 'name' => 'Ελλάδα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ER', 'name' => 'Ερυθραία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'EE', 'name' => 'Εσθονία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ZM', 'name' => 'Ζάμπια', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ZW', 'name' => 'Ζιμπάμπουε', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AE', 'name' => 'Ηνωμένα Αραβικά Εμιράτα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'US', 'name' => 'Ηνωμένες Πολιτείες Αμερικής', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'UM', 'name' => 'Απομακρυσμένες Νησίδες των Ηνωμένων Πολιτειών', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GB', 'name' => 'Ηνωμένο Βασίλειο', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'JP', 'name' => 'Ιαπωνία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'IN', 'name' => 'Ινδία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ID', 'name' => 'Ινδονησία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'JO', 'name' => 'Ιορδανία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'IQ', 'name' => 'Ιράκ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'IR', 'name' => 'Ιράν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'IE', 'name' => 'Ιρλανδία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GQ', 'name' => 'Ισημερινή Γουινέα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'EC', 'name' => 'Ισημερινός', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'IS', 'name' => 'Ισλανδία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ES', 'name' => 'Ισπανία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'IL', 'name' => 'Ισραήλ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'IT', 'name' => 'Ιταλία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KZ', 'name' => 'Καζακστάν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CM', 'name' => 'Καμερούν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KH', 'name' => 'Καμπότζη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CA', 'name' => 'Καναδάς', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'QA', 'name' => 'Κατάρ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CF', 'name' => 'Κεντροαφρικανική Δημοκρατία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KE', 'name' => 'Κένυα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CN', 'name' => 'Κίνα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KG', 'name' => 'Κιργιζία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KI', 'name' => 'Κιριμπάτι', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CG', 'name' => 'Κογκό', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CO', 'name' => 'Κολομβία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KM', 'name' => 'Κομόρες', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CR', 'name' => 'Κόστα Ρίκα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CU', 'name' => 'Κούβα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KW', 'name' => 'Κουβέιτ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CW', 'name' => 'Κουρασάο', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'HR', 'name' => 'Κροατία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CY', 'name' => 'Κύπρος', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CD', 'name' => 'Λαϊκή Δημοκρατία του Κογκό', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'LA', 'name' => 'Λάος', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'LS', 'name' => 'Λεσότο', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'LV', 'name' => 'Λεττονία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BY', 'name' => 'Λευκορωσία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'LB', 'name' => 'Λίβανος', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'LR', 'name' => 'Λιβερία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'LY', 'name' => 'Λιβύη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'LT', 'name' => 'Λιθουανία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'LI', 'name' => 'Λίχτενσταϊν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'LU', 'name' => 'Λουξεμβούργο', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'YT', 'name' => 'Μαγιότ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MG', 'name' => 'Μαδαγασκάρη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MO', 'name' => 'Μακάο', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MY', 'name' => 'Μαλαισία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MW', 'name' => 'Μαλάουι', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MV', 'name' => 'Μαλδίβες', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ML', 'name' => 'Μάλι', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MT', 'name' => 'Μάλτα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MA', 'name' => 'Μαρόκο', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MQ', 'name' => 'Μαρτινίκα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MU', 'name' => 'Μαυρίκιος', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MR', 'name' => 'Μαυριτανία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ME', 'name' => 'Μαυροβούνιο', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MX', 'name' => 'Μεξικό', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MM', 'name' => 'Μιανμάρ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MN', 'name' => 'Μογγολία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MZ', 'name' => 'Μοζαμβίκη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MD', 'name' => 'Μολδαβία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MC', 'name' => 'Μονακό', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MS', 'name' => 'Μοντσερράτ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BD', 'name' => 'Μπανγκλαντές', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BB', 'name' => 'Μπαρμπάντος', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BS', 'name' => 'Μπαχάμες', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BH', 'name' => 'Μπαχρέιν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BZ', 'name' => 'Μπελίζ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BJ', 'name' => 'Μπενίν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BES', 'name' => ' Μποναίρ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BW', 'name' => 'Μποτσουάνα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BF', 'name' => 'Μπουρκίνα Φάσο', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BI', 'name' => 'Μπουρούντι', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BT', 'name' => 'Μπουτάν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BN', 'name' => 'Μπρουνέι', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NA', 'name' => 'Ναμίμπια', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NR', 'name' => 'Ναουρού', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NZ', 'name' => 'Νέα Ζηλανδία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NC', 'name' => 'Νέα Καληδονία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NP', 'name' => 'Νεπάλ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'BV', 'name' => 'Μπουβέ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NF', 'name' => 'Νησί Νόρφολκ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CX', 'name' => 'Νήσος των Χριστουγέννων', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CC', 'name' => 'Νησιά Κόκος (Keeling)', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AX', 'name' => 'Ώλαντ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MP', 'name' => 'Βόρειες Μαριάνες Νήσοι', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MH', 'name' => 'Νήσοι Μάρσαλ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PN', 'name' => 'Νησιά Πίτκερν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KY', 'name' => 'Κέιμαν Νήσοι', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CK', 'name' => 'Νήσοι Κουκ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SB', 'name' => 'Νήσοι Σολομώντα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'FO', 'name' => 'Νήσοι Φερόες', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'FK', 'name' => 'Νήσοι Φώκλαντ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'IM', 'name' => 'Νήσος Μαν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'HM', 'name' => 'Νήσοι Χερντ και Μακντόναλντ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NE', 'name' => 'Νίγηρας', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NG', 'name' => 'Νιγηρία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NI', 'name' => 'Νικαράγουα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NU', 'name' => 'Νιούε', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NO', 'name' => 'Νορβηγία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ZA', 'name' => 'Νότια Αφρική', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'GS', 'name' => 'Νήσοι Νότια Γεωργία και Νότιες Σάντουιτς', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'KR', 'name' => 'Νότια Κορέα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SS', 'name' => 'Νότιο Σουδάν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'DM', 'name' => 'Δομινίκα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'NL', 'name' => 'Ολλανδία (Κάτω Χώρες)', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'AN', 'name' => 'Ολλανδικές Αντίλλες', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'OM', 'name' => 'Ομάν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'FM', 'name' => 'Ομόσπονδες Πολιτείες της Μικρονησίας', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'HN', 'name' => 'Ονδούρα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'WF', 'name' => 'Ουαλίς και Φουτουνά', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'HU', 'name' => 'Ουγγαρία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'UG', 'name' => 'Ουγκάντα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'UZ', 'name' => 'Ουζμπεκιστάν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'UA', 'name' => 'Ουκρανία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'UY', 'name' => 'Ουρουγουάη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PK', 'name' => 'Πακιστάν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PW', 'name' => 'Παλάου', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PA', 'name' => 'Παναμάς', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PG', 'name' => 'Παπούα Νέα Γουινέα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PY', 'name' => 'Παραγουάη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'VI', 'name' => 'Αμερικανικές Παρθένοι Νήσοι', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'MK', 'name' => 'Βόρεια Μακεδονία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PE', 'name' => 'Περού', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PL', 'name' => 'Πολωνία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PT', 'name' => 'Πορτογαλία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PR', 'name' => 'Πουέρτο Ρίκο', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CV', 'name' => 'Πράσινο Ακρωτήρι', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'RE', 'name' => 'Ρεϊνιόν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'RW', 'name' => 'Ρουάντα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'RO', 'name' => 'Ρουμανία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'RU', 'name' => 'Ρωσία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'WS', 'name' => 'Σαμόα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SH', 'name' => 'Νήσος Αγίας Ελένης', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'ST', 'name' => 'Σάο Τομέ και Πρίνσιπε', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SA', 'name' => 'Σαουδική Αραβία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SJ', 'name' => 'Σβάλμπαρντ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SN', 'name' => 'Σενεγάλη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'RS', 'name' => 'Σερβία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SC', 'name' => 'Σεϋχέλλες', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SL', 'name' => 'Σιέρα Λεόνε', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SG', 'name' => 'Σιγκαπούρη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SK', 'name' => 'Σλοβακία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SI', 'name' => 'Σλοβενία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SO', 'name' => 'Σομαλία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SZ', 'name' => 'Εσουατίνι', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SD', 'name' => 'Σουδάν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SE', 'name' => 'Σουηδία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SR', 'name' => 'Σουρινάμ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'LK', 'name' => 'Σρι Λάνκα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'SY', 'name' => 'Συρία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TW', 'name' => 'Ταϊβάν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TH', 'name' => 'Ταϊλάνδη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TZ', 'name' => 'Τανζανία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TJ', 'name' => 'Τατζικιστάν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TC', 'name' => 'Τερκς και Κέικος', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'JM', 'name' => 'Τζαμάικα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'JE', 'name' => 'Τζέρσεϊ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'DJ', 'name' => 'Τζιμπουτί', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TO', 'name' => 'Τόγκα', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TG', 'name' => 'Τόγκο', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TK', 'name' => 'Τοκελάου', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TV', 'name' => 'Τουβαλού', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TR', 'name' => 'Τουρκία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TM', 'name' => 'Τουρκμενιστάν', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TT', 'name' => 'Τρινιντάντ και Τομπάγκο', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TD', 'name' => 'Τσαντ', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CZ', 'name' => 'Τσεχία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'TN', 'name' => 'Τυνησία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'YE', 'name' => 'Υεμένη', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'PH', 'name' => 'Φιλιππίνες', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'FI', 'name' => 'Φινλανδία', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'FJ', 'name' => 'Φίτζι', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'CL', 'name' => 'Χιλή', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'HK', 'name' => 'Χονγκ Κονγκ', 'created_at' => $now, 'updated_at' => $now],
        ];
    }
}
