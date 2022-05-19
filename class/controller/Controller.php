<?php

class Controller
{

    public function __construct()
    {}

    function sanitize($stringANetejar, $convertirAlowercase = 0)
    {
        if (empty($stringANetejar)) {
            $stringANetejar = "";
        } else {
            $stringANetejar = trim($stringANetejar);
            $stringANetejar = htmlspecialchars(stripslashes(trim($stringANetejar, '-')));
            $stringANetejar = strip_tags($stringANetejar);
            // Preserve escaped octets.
            $stringANetejar = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $stringANetejar);
            // Remove percent signs that are not part of an octet.
            $stringANetejar = str_replace('%', '', $stringANetejar);
            // Restore octets.
            $stringANetejar = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $stringANetejar);

            switch ($convertirAlowercase) {
                case 1:
                    if (function_exists('mb_strtolower')) {
                        $stringANetejar = mb_strtolower($stringANetejar, 'UTF-8');
                    } else {
                        $stringANetejar = strtolower($stringANetejar);
                    }
                    break;
                case 2:
                    if (function_exists('mb_strtoupper')) {
                        $stringANetejar = mb_strtoupper($stringANetejar, 'UTF-8');
                    } else {
                        $stringANetejar = strtoupper($stringANetejar);
                    }
                    break;
                case 3:
                    if (function_exists('mb_strtoupper') && function_exists('mb_strtolower')) {
                        $stringANetejar = mb_strtolower($stringANetejar, 'UTF-8');
                        $stringANetejar[0] = mb_strtoupper($stringANetejar[0], 'UTF-8');
                    } else {
                        $stringANetejar = strtolower($stringANetejar);
                        $stringANetejar[0] = strtoupper($stringANetejar[0]);
                    }
                    break;
                case 4:
                    if (function_exists('mb_strtoupper') && function_exists('mb_strtolower')) {
                        $stringANetejar = mb_strtolower($stringANetejar, 'UTF-8');
                        $stringANetejar[0] = mb_strtoupper($stringANetejar[0], 'UTF-8');
                        $inici = 0;
                        while ($pos = strpos($stringANetejar, " ", $inici)) {
                            $inici = $pos + 1;
                            $stringANetejar[$inici] = mb_strtoupper($stringANetejar[$inici], 'UTF-8');
                        }
                    } else {
                        $stringANetejar = strtolower($stringANetejar);
                        $stringANetejar[0] = strtoupper($stringANetejar[0]);
                        $inici = 0;
                        while ($pos = strpos($stringANetejar, " ", $inici)) {
                            $inici = $pos + 1;
                            $stringANetejar[$inici] = strtoupper($stringANetejar[$inici]);
                        }
                    }
                    break;
            }
        }
        return $stringANetejar;
    }

    /*
     * funció html_generateSelect: a partir d'un array associatiu, genera codi
     * html per la visualització d'un control SELECT-OPTION generand un menú
     * desplegable.
     *
     * paràmetres:
     * * opcions: array associatiu, en el que la clau representa el valor a definir i
     * el valor serà el text a mostrar.
     * * atributs: (Opcional) Array associatiu amb parelles atribut-valor segons la
     * definició html.
     * https://www.w3schools.com/tags/tag_select.asp apartat Attributes
     * autofocus: boolean
     * disabled: boolean
     * form: string
     * multible: boolean
     * name: string
     * required: boolean
     * size: integer
     * class: string
     * id: string
     * label: string
     *
     * return: El resultat és un string amb el codi html del contol select-option
     */
    function html_generateSelect($opcions, $seleccionat, $atributs)
    {
        if (isset($atributs)) {
            // atribut autofocus: boolean
            if ($atributs['autofocus'] === true) {
                $attAutofocus = "autofocus ";
            }

            // atribut disabled: boolean
            if ($atributs['disabled'] === true) {
                $attDisabled = "disabled ";
            }

            // atribut form: string
            if (isset($atributs['form'])) {
                $attForm = "form=\"{$atributs['form']}\"";
            }

            // atribut multible: boolean
            if (isset($atributs['multiple'])) {
                $attMultiple = "multiple";
            }

            // atribut name: string
            if (isset($atributs['name'])) {
                $attName = "name=\"{$atributs['name']}\"";
            }

            // atribut required: boolean
            if (isset($atributs['required'])) {
                $attRequred = "required";
            }

            // atribut size: integer
            if (isset($atributs['size'])) {
                $attSize = "size=\"{$atributs['size']}\"";
            }

            // atribut class: string
            if (isset($atributs['class'])) {
                $attClass = "class=\"{$atributs['class']}\"";
            }

            // atribut id: string
            if (isset($atributs['id'])) {
                $attId = "id=\"{$atributs['id']}\"";
            }

            // label no és un atribut, però ho tractarem com si ho fos.
            if (isset($atributs['label'])) {
                $attLabel = "<label for='" . $atributs['id'] . "'>" . $atributs['label'] . "</label><br/>\n";
            }
        }

        $resultat = $attLabel;
        $resultat .= "<select $attId $attClass $attName $attSize $attForm $attRequred $attMultiple $attDisabled $attAutofocus>\n";
        foreach ($opcions as $key => $value) {
            $resultat .= "<option value=\"$key\"";
            if (isset($seleccionat) && $seleccionat === $key) {
                $resultat .= " selected";
            }
            $resultat .= ">" . ucwords($value) . "</option>\n";
        }
        $resultat .= "</select>\n";
        if (isset($atributs['span'])) {
            $resultat .= "<span class=\"error\" > {$atributs['span']} </span>\n";
        }

        return $resultat;
    }

    /*
     * funció html_generateChekBox: a partir d'un array associatiu, genera codi
     * html per la visualització dels controls CHECK-BOX.
     *
     * paràmetres:
     * * opcions: array associatiu, amb la clau que representa l'identificador html
     * únic (l'id) i el valor serà un array amb les següents claus:
     * "name" que representa el valor a definir,
     * "label" que emmagatzemarà el text a mostrar,
     * "value" el valor a assignar,
     * "checked" que emmagatzemarà un valor booleà.
     * * abans: (Per defecte true) Defineix el label abans/dreprés del checkbox
     *
     * return: El resultat és un string amb el codi html del contol select-option
     */
    function html_generateCheckBox($opcions, $abans = "true")
    {
        foreach ($opcions as $key => $value) {
            $bChecked = ($value['checked']) ? true : false;
            unset($value['checked']);
            $label = "<label for=\"{$key}\">{$value['label']}</label><br>\n";
            unset($value['label']);

            $value["type"] = "checkbox";
            $value["id"] = $key;
            $input = html_generaInput($value);
            $input = ($bChecked) ? str_replace(">", "checked >", $input) : $input;

            if ($abans) {
                $resultat .= "$input\n$label";
            } else {
                $resultat .= "$label\n$input";
            }
        }

        return $resultat;
    }

    /*
     * funció html_generateChekBox: a partir d'un array associatiu, genera codi
     * html per la visualització dels controls CHECK-BOX.
     *
     * paràmetres:
     * * opcions: array associatiu, amb la clau que representa l'identificador html
     * únic (l'id) i el valor serà un array amb les següents claus:
     * "name" que representa el valor a definir,
     * "label" que emmagatzemarà el text a mostrar,
     * "value" el valor a assignar,
     * "checked" que emmagatzemarà un valor booleà.
     * * abans: (Per defecte true) Defineix el label abans/dreprés del checkbox
     *
     * return: El resultat és un string amb el codi html del contol select-option
     */
    function html_generateRadioButon($opcions, $abans = "true")
    {
        foreach ($opcions as $key => $value) {
            $bChecked = ($value['checked']) ? true : false;
            unset($value['checked']);
            $label = "<label for=\"{$key}\" class=\"fs-form\">{$value['label']}</label>";
            unset($value['label']);

            $value["type"] = "radio";
            $value["id"] = $key;
            $input = html_generaInput($value);
            $input = ($bChecked) ? str_replace(">", "checked >", $input) : $input;

            if ($abans) {
                $resultat .= "$input\n$label";
            } else {
                $resultat .= "$label\n$input";
            }
        }

        return $resultat;
    }

    /*
     * funció html_generateInput: a partir d'un array associatiu, genera codi
     * html per la visualització dels controls INPUT.
     *
     * paràmetres:
     * * opcions: array associatiu, amb la clau que representa l'identificador html
     * únic (l'id) i el valor serà un array amb les següents claus:
     * "type"
     * "name" ,
     * "placeholder"
     * "class"
     * "value"
     * o qualsevol altre atribut de INPUT
     *
     * return: El resultat és un string amb el codi html del contol select-option
     */
    function html_generaInput($options)
    {
        $resultat = "<input ";

        foreach ($options as $key => $value) {
            $resultat .= ($key != "span") ? "$key =\"$value\" " : "";
        }
        $resultat .= ">\n";
        if (isset($options['span'])) {
            $resultat .= "<span class=\"error\" > {$options['span']} </span>\n";
        }
        return $resultat;
    }
}

