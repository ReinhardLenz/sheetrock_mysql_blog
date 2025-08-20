
<?php include('../templates/header.php'); 
    include "blog1_logic.php";
// choose visitor language, e.g. en | fi | fr | ru

$strings = json_decode(
    file_get_contents(__DIR__ . '/../language_json/languages_Blog.json'),
    true                              // associative array, not objects
);

function t1(string $id): string
{
    global $strings, $lang;
    return htmlspecialchars($strings[$lang][$id] ?? '', ENT_QUOTES, 'UTF-8');
}
    $lang=$_SESSION['lang'];
?>

<head>
<!-- English -->
<meta name="description" lang="en" content="A personal blog blending weekly stories and bite-sized inspirations on travel, singing, electronics, orienteering, baking, and everyday curiosities. No politics, just pure hobbies and reflections.">
<meta name="keywords" lang="en" content="personal blog, weekly stories, travel blog, hobby blog, singing, electronics, orienteering, baking, creative writing, Finland blog, inspirational ideas, non-political blog, verbal exhibitionism, Finnish hobbies, lifestyle journal, quirky thoughts">


<!-- Finnish -->
<meta name="description" lang="fi" content="Henkilökohtainen blogi, jossa viikoittaisia tarinoita ja lyhyitä oivalluksia matkailusta, laulusta, elektroniikasta, suunnistuksesta, leivonnasta ja arjen iloista. Ei politiikkaa, vain harrastuksia ja ajatuksia.">
<meta name="keywords" lang="fi" content="henkilökohtainen blogi, viikkotarinoita, matkailu, harrastukset, kuorolaulu, elektroniikka, suunnistus, leivonta, luova kirjoittaminen, Suomi blogi, inspiraatio, ei politiikkaa, sanallinen ekshibitionismi, suomalaiset harrastukset, elämäntyyli, omintakeiset ajatukset">


<!-- French -->
<meta name="description" lang="fr" content="Un blog personnel mêlant récits hebdomadaires et éclats d’inspiration sur le voyage, le chant, l’électronique, l’orientation, la pâtisserie et les curiosités du quotidien. Aucun contenu politique, juste des passions et des réflexions.">
<meta name="keywords" lang="fr" content="blog personnel, récits hebdomadaires, blog de voyage, blog de loisirs, chant, électronique, orientation, pâtisserie, écriture créative, blog Finlande, idées inspirantes, sans politique, exhibitionnisme verbal, loisirs finlandais, journal de vie, pensées originales">


<!-- Russian -->
<meta name="description" lang="ru" content="Личный блог с еженедельными историями и короткими мыслями о путешествиях, пении, электронике, ориентировании, выпечке и повседневных радостях. Никакой политики — только увлечения и размышления.">
<meta name="keywords" lang="ru" content="личный блог, еженедельные истории, блог о путешествиях, блог о хобби, пение, электроника, ориентирование, выпечка, креативное письмо, блог о Финляндии, вдохновение, без политики, словесный эксгибиционизм, финские хобби, дневник жизни, оригинальные мысли">



</head>



<br>
<h1><?= t1('BLOG1') ?></h1>

<p><?= t1('BLOG2') ?></p>
<br>
<img src="../muutkuvat/fountainpen.jpg"> 

<!--insert start -->

<button onclick="speakChild2('<?php
if ($lang=='fi') {
    echo 'fi-FI';
} elseif ($lang=='fr') { 
    echo 'fr-FR';
} elseif ($lang=='en') {
    echo 'en-GB';
} else { 
    echo 'ru-RU';
}
?>')">🔊 Listen</button>

<script>
function speakChild2(lang) {
  const element = document.querySelector(".child2");
  if (!element) return;
  const text = element.innerText;

  // Ensure voices are loaded
  function doSpeak() {
    let voices = speechSynthesis.getVoices();
    console.log("Available voices:", voices.map(v => [v.name, v.lang]));

    let voice = voices.find(v => v.lang === lang);
    if (!voice) {
      // fallback: try Google voices or same language prefix
      voice = voices.find(v => v.name.toLowerCase().includes("google") && v.lang.startsWith(lang.split("-")[0]));
    }

    const utterance = new SpeechSynthesisUtterance(text);
    if (voice) {
      utterance.voice = voice;
      utterance.lang = voice.lang;
    } else {
      utterance.lang = lang; // fallback
    }
    speechSynthesis.cancel();
    speechSynthesis.speak(utterance);
  }

  if (speechSynthesis.getVoices().length === 0) {
    speechSynthesis.onvoiceschanged = doSpeak;
  } else {
    doSpeak();
  }
}
</script>

<!--insert end -->
<!--      -->

<div class="parent">
    <div class="child1">

            <div class="container mt-5">

                <!-- Display any info -->
                <?php if(isset($_REQUEST['info'])){ ?>
                    <?php if($_REQUEST['info'] == "added"){?>
                        <div class="alert alert-success" role="alert">
                        <?= t1('BLOG9') ?>
                        </div>
                    <?php }?>
                <?php } ?>

                <!-- Create a new Post button -->
                <div class="text-center">
                    <a href="blog1_create.php" class="btn btn-outline-dark"><?= t1('BLOG3') ?></a>
                </div>


                

                <!-- Display posts from database -->





                        <!-- $max_number_of_rows['total'];  -->

                <div class="row">
                    <?php //foreach($query as $q){ ?>    
                    <?php foreach($query as $q){ ?>
                        <div class="col-12 col-lg-4 d-flex justify-content-center">
                            <div class="card text-white bg-dark mt-5" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $q['title'];?></h5>
                                    <p class="card-text"><?php echo substr($q['content'], 0, 50);?>...</p>
                                    <a href="blog1_view.php?id=<?php echo $q['id']?>" class="btn btn-light"><?= t1('BLOG4') ?> <span class="text-danger">&rarr;</span></a>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                </div>






        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


    <!-- tÃƒÂ¤ssÃƒÂ¤ loppuu ensimmÃƒÂ¤inen column tai blogi     -->

    </div>

        <!--   column toita blogia varten   -->
    <div class="child2">
        <!--    tÃƒÂ¤hÃƒÂ¤n se toinen blogi  -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sheetrock/1.1.4/dist/sheetrock.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.min.js"></script>

            <table id="my-table" class="table table-condensed table-striped"></table>
            <hr>
            
            <ol id="blog">
                <script id="template" type="text/x-handlebars-template">
                    <li>
                        {{ cells.<?php echo $lang;?> }}
                    </li>
                </script>
            </ol>

        <script>
        console.clear();
        var language = <?php echo json_encode($lang); ?>;
        console.log(language);
        const sheetUrl_2 ='https://docs.google.com/spreadsheets/d/4QLSsqasvraQWEps3S_ewrq-s3D-oElQWQgf34ZARqq9S/edit?#gid=0'
        const template = Handlebars.compile($('#template').html());

        $(function(){
            $('#blog').sheetrock({
                url: sheetUrl_2,
                query: "select  B, C, D, E order by A asc",

                fetchSize: 20,
                rowTemplate: template
            });
        })
        </script>
    </div>
</div>






<?php include('../templates/footer.php'); ?>
