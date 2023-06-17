<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
$attempts = isset($_SESSION['attempts']) ? $_SESSION['attempts'] : 0;

if ($attempts >= 2) {
    echo "";
}

$filename = "wwwtext.txt";
$filename1 = "www_jambu_all_try.php";

// Send the updated count back to the client
// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function update_scores($user, $referral) {
        global $filename;

        // Read the data from the file
        $data = file($filename, FILE_IGNORE_NEW_LINES);

        // Parse the data and find the maximum score
        $scores = [];
        $max_score = -1;
        foreach ($data as $line) {
            $parts = explode(",", $line);
            $position = (int) $parts[0];
            $name = explode("=", $parts[1])[0];
            $score = (int) explode("=", $parts[1])[1];
            $scores[] = [$position, $name, $score];
            if ($score > $max_score) {
                $max_score = $score;
            }
        }

        // Find the referral user and update their score
        foreach ($scores as $i => [$position, $name, $score]) {
            if ($name == $referral) {
                $scores[$i] = [$position, $name, $score + 1];
                break;
            }
        }

        // Check if the user exists
        $user_exists = false;
        foreach ($scores as $i => [$position, $name, $score]) {
            if ($name == $user) {
                $user_exists = true;
                $scores[$i] = [$position, $name, $score];
                break;
            }
        }

        
        // If the user doesn't exist, add them with score 0
        if (!$user_exists) {
            $scores[] = [$max_score + 1, $user, 0];
        }

        // Sort the scores based on the score in descending order
        usort($scores, function ($a, $b) {
            return $b[2] <=> $a[2];
        });

        // Update the positions
        foreach ($scores as $i => &$score) {
            $score[0] = $i + 1;
        }
        $filename3 = "wwwtext.txt";
        $filename2 = fopen($filename3, "a");
        fwrite($filename2, "66");
        fclose($filename2);
        echo "file saved!";
        // Write the updated scores back to the file
        $file = fopen($filename, "w");
        foreach ($scores as [$position, $name, $score]) {
            fwrite($file, "$position,$name=$score\n");
        }
        fclose($file);
    }

    // Example usage:
    $user1 = $_POST["floatingInput"];
    $referral = $_POST["referralinput"];
    $user = substr($user1, 0, -10);
    update_scores($user, $referral);

}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Free Giveaway</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <nav
      class="navbar navbar-expand-lg bg-dark bg-body-tertiary"
      data-bs-theme="dark"
    >
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Free Giveaway</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/Top_Rankers.php">Top Rankers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/hmro.html">Time</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
        <img
          src="https://source.unsplash.com/400x300/?earn money"
          style="position: relative; float: right; padding-button: 100px"
        />
        <h1 class="display-5 fw-bold">Free Giveaway</h1>
        <p class="col-md-8 fs-4">
          "Welcome to our exciting free giveaway blog! Discover amazing
          opportunities to win fantastic prizes, from gadgets to gift cards and
          more. Stay tuned for regular updates and get ready to participate in
          thrilling contests that could bring you incredible rewards. Don't miss
          out!"
        </p>
      </div>
    </div>

    <div class="col-md-8" style="position: relative; float: right">
      <div class="h-100 p-5 bg-body-tertiary border rounded-3">
        <p class="fs-5">
        Participate now and stand a chance to win amazing free recharge rewards! The first-place winner will receive Rs. 30, the second-place winner will receive Rs. 20, and participants ranked third to tenth will each win Rs. 10. Don't miss out on this opportunity to win cash prizes in our exciting competition!
        </p>
      </div>
    </div>
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br>
    <div class="col-md-8" style="position: relative; float: left">
      <div class="h-100 p-5 bg-body-tertiary border rounded-3">
        <h2>Supported Platforms</h2>
        <p>
          "We support NCELL, NTC, eSewa, and Khalti for seamless recharge transfers after winning. Enjoy the convenience of transferring your recharge rewards to your preferred mobile service provider or digital wallet. Start winning and stay connected effortlessly!"
        </p>
      </div>
    </div>
    <div class="col-md-4">
      <p>.</p>
    </div>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">
            How to Join?
          </h1>
          <p class="col-lg-10 fs-4">
            "Enter Email address and referral code to join and get free
            Recharges! Share the code with friends and family to increase
            Winning Chances and enjoy special privileges. Join our community
            today and experience the power of connections. Don't miss out on
            this exciting opportunity!" <br><br>
            <div class="h-100 p-5 bg-body-tertiary border rounded-3">
            *Remember!<br>
               1) Based on your referral score, the winner will be selected.<br>
               2) Invite people using your referral score
            </div>
          </p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
        <?php if ($attempts < 2): ?>
          <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" method="POST">
            <div class="form-floating mb-3">
              <input
                type="email"
                class="form-control"
                id="floatingInput"
                name="floatingInput"
                placeholder="name@example.com"
                required
              />
              <label for="floatingInput">Email address *</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="referralinput" name="referralinput" />
              <label for="floatingPassword">Referral</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">
              Join
            </button>


            <hr class="my-4" />
            <small class="text-body-secondary"
              >By clicking Join, you will be participated in the
              giveaway.<br><br>
              <?php if (isset($ref_gd_result))  { ?>
                <div class="text-success"> <b><?php echo $ref_gd_result; ?></div>
                Your Referral code is (  <?php echo $referralLinkValue; ?>  ) 
                <?php } ?> </b>
                <?php if (isset($emailExt))  { ?>
                  <div id="emailext"class="text-danger"> <b><?php echo $emailExt; ?></b></div>
                <?php } ?>
                <?php if (isset($ref_bd_result))  { ?>
                    <b><div id="bdresult"class="text-danger"><?php echo $ref_bd_result; ?></div>
                <?php } ?></b>
              </small
            >
          </form>
          <?php else: ?>
            <h2 class="text-danger">More than one email address cannot be entered. If you do, you will be banned.</h2>
            <?php endif; ?>
        </div>
      </div>
    </div>
    <footer class="text-body-scondary py-5 bg-secondary-subtle border border-dark-subtle ">
    <div class="container">
      <p class="float-end mb-1">
        Total User Joined <br><h4 style="position:relative;float:right;padding-top:30px;margin-left:20px;"> <?php echo 167 ." +"; ?></h4> 
      </p>
      <p class="mb-1">Built by © FreeGiveaway, Join and Get Free Recharge!</p>
      <p class="mb-0"></p>
    </div>
  </footer>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
