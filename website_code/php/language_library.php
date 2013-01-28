<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tom
 * Date: 23-1-13
 * Time: 12:20
 * To change this template use File | Settings | File Templates.
 */
_load_language_file("/website_code/php/language_library.inc");

function getLanguages()
{
    libxml_use_internal_errors(true);
    $xml = simplexml_load_file(dirname(__FILE__) . "/../../languages/language-config.xml");
    $langs = array();

    $xml_langs = $xml->xpath('/*/language');
    foreach ($xml_langs as $xml_lang)
    {
        $langs[(string)$xml_lang['code']] = (string)$xml_lang['name'];
    }
    return $langs;
}

function display_language_selectionform($formclass)
{
    if ($formclass != "")
    {
        ?>
        <form action='' method='POST' class="<?php echo $formclass; ?>">
        <label for="language-selector"></label>
        <?php
    }
    else
    {
        ?>
        <form action='' method='POST'>
        <label for="language-selector"><?PHP echo LANGUAGE_PROMPT; ?></label>
        <?php
    }
?>

        <select name='language' id="language-selector">
          <?php
          /* I've just specified a random list of possible languages; "Nonsense" is minimal and just there so you can see the login page switch around */
          $languages = getLanguages();
          //$languages = array('en-GB' => 'English', 'nl-NL' => 'Nederlands', 'en-XX' => 'Nonsense', 'fr-FR' => 'French', 'es-ES' => 'Spanish', 'it-IT' => 'Italian', 'ca-ES' => "Catalan");
          foreach ($languages as $key => $value) {
              $selected = '';
              if (isset($_SESSION['toolkits_language']) && $_SESSION['toolkits_language'] == $key) {
                  $selected = " selected=selected ";
              }
              echo "<option value='{$key}' $selected>{$value}</option>\n";
          }
          ?>
        </select>
        <input type='submit' value='<?PHP echo LANGUAGE_BUTTON_TEXT; ?>' name='submit'/>
    </form>
<?php
}
?>
