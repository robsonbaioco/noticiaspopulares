<?php
    require_once 'controllers/getNews.php';
    $country       = 'br';
    $news          = getNewsTopHeadlines($country);
    $articles      = $news['articles'];
    $total_results = $news['totalResults'];

    //converts datetime format to a more readable format
    function convertDateTime($datetime) {
        $date = new DateTime($datetime);
        return $date->format('d/m/Y H:i:s');
    }

    $articles = array_map(function($article) {
        $article['publishedAt'] = convertDateTime($article['publishedAt']);
        return $article;
    }, $articles);

    $main_article = $articles[0];
    //subtract the main article from the array
    array_shift($articles);

    //get the next 3 articles from the array
    $secondary_articles = array_slice($articles, 0, 3);
    
    //remove the next 3 articles from the array
    array_splice($articles, 0, 3);

?>
<!DOCTYPE html>
<html lang="zxx">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Notícias populares</title>
    <!-- plugin css for this page -->
    <link
      rel="stylesheet"
      href="./assets/vendors/mdi/css/materialdesignicons.min.css"
    />
    <link rel="stylesheet" href="assets/vendors/aos/dist/aos.css/aos.css" />

    <!-- End plugin css for this page -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
  </head>

  <body>
    <div class="container-scroller">
      <div class="main-panel">
        <!-- partial:partials/_navbar.html -->
        <header id="header">
          <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
              <div class="">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <a class="navbar-brand" href="#"
                      ><img src="assets/images/logo.png" alt=""
                    /></a>
                  </div>
                </div>
              </div>
            </nav>
          </div>
        </header>

        <!-- partial -->
        <div class="content-wrapper">
          <div class="container">
            <div class="row" data-aos="fade-up">
              <div class="col-xl-12 stretch-card grid-margin">
                <a href="<?= $main_article['url'] ?>">
                    <div class="position-relative">
                      <img
                        src= "<?= $main_article['urlToImage']; ?>"
                        alt="banner"
                        class="img-fluid"
                      />
                      <div class="banner-content">
                        <h1 class="mb-0"><?= $main_article['title'] ?></h1>
                        <h3>
                            <?= $main_article['description'] ?>
                        </h3>
                        <div class="fs-12">
                          <span class="mr-2">Por <?= $main_article['author'] ?>, publicado em <?= $main_article['publishedAt'] ?> </span>
                        </div>
                      </div>
                    </div>
                </a>
              </div>
              <div class="col-xl-12 stretch-card grid-margin">
                <div class="card bg-dark text-white">
                  <div class="card-body">
                    <h2>Últimas Notícias</h2>

                    <?php foreach ($secondary_articles as $article) : ?>
                        <div
                        class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between"
                        >
                            <div class="pr-3">
                                <h5>
                                    <a href="<?= $article['url'] ?>" class="text-white">
                                        <?= $article['title'] ?>
                                    </a>
                                </h5>
                                <div class="fs-12">
                                    <span class="mr-2"><?= $article['description'] ?> </span>
                                </div>
                                <div class="fs-12">
                                    <span class="mr-2">Por <?= $article['author'] ?>, publicado em <?= $article['publishedAt'] ?> </span>
                                </div>
                            </div>
                            <div class="rotate-img">
                                <img
                                src="<?= $article['urlToImage']; ?>"
                                alt="thumb"
                                class="img-fluid img-lg"
                                />
                            </div>
                        </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" data-aos="fade-up">
              <div class="col-lg-12 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">               
                    <?php foreach($articles as $article): ?>
                        <div class="row">
                          <div class="col-sm-4 grid-margin">
                            <div class="position-relative">
                              <div class="rotate-img">
                                <img
                                  src="<?= $article['urlToImage']; ?>"
                                  alt="thumb"
                                  class="img-fluid"
                                />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-8  grid-margin">
                            <h2 class="mb-2 font-weight-600">
                                <a href="<?= $article['url'] ?>">
                                    <?= $article['title'] ?>
                                </a>
                            </h2>
                            <div class="fs-13 mb-2">
                              <span class="mr-2">Por <?= $article['author'] ?>, publicado em <?= $article['publishedAt'] ?></span>
                            </div>
                            <p class="mb-0">
                                <?= $article['description'] ?>
                            </p>
                          </div>
                        </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- main-panel ends -->
        <!-- container-scroller ends -->

        <!-- partial:partials/_footer.html -->
        <footer>
          <div class="footer-top">
            <div class="container">
              <div class="row">
                <div class="col-sm-5">
                  <img src="assets/images/logo.png" class="footer-logo" alt="" />
                  <h5 class="font-weight-normal mt-4 mb-5">
                    Notícias populares é o seu agregador de notícias, onde você pode conferir as principais notícias do Brasil.                    
                  </h5>     
                </div>
              </div>
            </div>
          </div>
          <div class="footer-bottom">
            <div class="container">
              <div class="row">
                <div class="col-sm-12">
                  <div class="d-sm-flex justify-content-between align-items-center">
                    <div class="fs-14 font-weight-600">
                      © 2022 @ <a href="https://www.bootstrapdash.com/" target="_blank" class="text-white"> BootstrapDash</a>. All rights reserved.
                    </div>
                    <div class="fs-14 font-weight-600">
                      Handcrafted by <a href="https://www.bootstrapdash.com/" target="_blank" class="text-white">BootstrapDash</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </footer>

        <!-- partial -->
      </div>
    </div>
    <!-- inject:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="assets/vendors/aos/dist/aos.js/aos.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="./assets/js/demo.js"></script>
    <script src="./assets/js/jquery.easeScroll.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>
