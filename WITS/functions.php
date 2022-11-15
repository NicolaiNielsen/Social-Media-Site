<?php
require_once "/home/mir/lib/db.php";

//Funktion der checker om vi er logget og gemmer divs
function checkIfLoggedInAndHideElement($suser, $spw) {
    if (!empty($_SESSION['suser'] && $_SESSION['spw']))
    {
        $show  = "style='display:block'";
        echo $show;
      } else {
        $show = "style='display:none'";
        echo $show;
      }
}


//Logud funktion der ødelægger session + refresher siden
function logOut() {
if(isset($_POST["logout"])) {
    session_destroy();
    echo "<meta http-equiv='refresh' content='0'>";   
  }
}

// funktion der laver html feeden
function createHTMLFeed() {

    $blogposts = get_pids();
    $latestpostslatest = array_reverse($blogposts, false);
    // printer hvert blogindlæg i html format
    foreach($latestpostslatest as $value) { //looper gennem all posts
      $blogid = get_post($value); // den individuelle post bl
  
      echo 
      "<div class='postfeed'>
          <div class='post_headerText'>
            <h3><a href=\"blogpost.php?pid=$value\">$value. $blogid[title]</a></h3>
          </div>
          <div class='post_headerDescription'>
            <p>$blogid[content]</p>
            <p>skrevet af <a href=\"profile.php?uid=$blogid[uid]\">$blogid[uid]</a></p>
            <p>$blogid[date]</p>
          </div>
      </div>";
   }
  }

// Funktion der checker om det først er post-information
// herefter checkes der om uploaded et billede, hvor 
function uploadPost() {
   if  (isset($_POST["postblog"])) {
    if (empty($_FILES['img']['tmp_name'])) { //hvis intet billede - upload post 
        echo "<meta http-equiv='refresh' content='0'>";
        $getPID = add_post($_SESSION['suser'], $_POST["blogtitle"], $_POST["blogcontent"]); //upload post
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        $name = $_FILES['img']['tmp_name'];
        $s = $_FILES['img']['type'];
        $substringtype = str_replace('image/', '', $s); // laver en substring til filtypen
        $dot = ".";
        $filetype = $dot.$substringtype;
        $getPID = add_post($_SESSION['suser'], $_POST["blogtitle"], $_POST["blogcontent"]); // uploader blogindlægget
        $imageid = add_image($name, $filetype); // finder imageid
        add_attachment($getPID, $imageid); //tilføjer billedet til den specifikke post
        echo "<meta http-equiv='refresh' content='0'>";
      }
  }
}

// få billederne tilknyttet postenid
function getPictures($pid) {
    $imageid = get_iids_by_pid($pid);
        foreach($imageid as $value) {
        $image = get_image($value);
        $imagepath = $image['path'];
        echo "<div class='box box1'><img src=$imagepath alt=''></div>";
    }
}

//Funktion til at få kommentarer og slette
function getComments($pid) {

    $comments = get_cids_by_pid($pid);
    $count = 0; //bruges til at generere unikke buttonids for hver kommentar
    $post = get_post($pid);

    echo $_SESSION['suser'];
    echo $post['uid'];


    foreach($comments as $comment) { //looper gennem alle kommentarer
      $currentcomment = get_comment($comment);
      $show  = "style='display:none'";
    
        if ($_SESSION['suser'] == $post['uid']) { //hvis din post, så viser vi delete knappen på alle kommentarer
        $show  = "style='display:block'";

        echo "DIN POST DU KAN SLETTE ALT";
        
        echo 
        "<div class='post_comments'>
          <p id='comment'> $currentcomment[cid]. $currentcomment[content]</p> 
          <p><a href=\"profile.php?uid=$currentcomment[uid]\">$currentcomment[uid]</a></p> 
        </div>
        <form method='post'>
        <input type='submit' $show name='delete$count' value='Delete'/>
      </form>";

        } elseif (!$_SESSION['suser'] != $post['uid']) { //hvis ikke din post 
        echo "IKKE DIN POST";

            if ($currentcomment['uid'] == $_SESSION['suser']) { //hvis din kommentar, vis delete knappen
                echo "DIN KOMMENTAR";
                $show = "style='display:block'"; 
                echo $show;
            
                echo
                "<div class='post_comments'>
                    <p id='comment'> $currentcomment[cid]. $currentcomment[content]</p>
                    <p id='author'><a href=\"profile.php?uid=$currentcomment[uid]\">$currentcomment[uid]</a></p>
                </div>
                <div>
                <form method='post'>
                  <input type='submit' $show name='delete$count' value='Delete'/>
                </form>
                </div>";

        }   elseif  ($currentcomment['uid'] != $_SESSION['suser']) { //hvis ikke din kommentar, så gem delete knappen
            echo "IKKE DIN KOMMENTAR";
            $show = "style='display:none'"; 

            echo
            "<div class='post_comments'>
                <p id='comment'> $currentcomment[cid]. $currentcomment[content]</p>
                <p id='author'><a href=\"profile.php?uid=$currentcomment[uid]\">$currentcomment[uid]</a></p>
            </div>
            <div>
            <form method='post'>
              <input type='submit' $show name='delete$count' value='Delete'/>
            </form>
            </div>";
        }
      }

        $currentButtonCount = "delete{$count}"; //reference til det generede knap navn, hvert loop og kommentar delete1, delete2, delete3..

        if(isset($_POST[$currentButtonCount])) { //hvis tryk på knap, slet kommentar
            delete_comment($currentcomment['cid']);
            echo "<meta http-equiv='refresh' content='0'>"; // REFRESH SIDE
        }
        
        $count++;
    }
}
?>
