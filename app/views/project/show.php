<?php view('header', ['site' => $site]); ?>
<div class="portfolio-modal m-lg-3" style="padding-top: 5rem;" id="portfolioModal4">
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header border-0 justify-content-end">
            <a href="<?= BASE_URL; ?>" class="btn btn-secondary">Back</a>
        </div>
        <div class="modal-body text-center pb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <!-- Portfolio Modal - Title-->
                        <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"><?= $project['name']; ?></h2>
                        <!-- Icon Divider-->
                        <div class="divider-custom">
                            <div class="divider-custom-line"></div>
                            <div class="divider-custom-icon">
                                <svg class="icon-star" style="fill: #2c3e50;">
                                    <use xlink:href="#icon-star"></use>
                                </svg>
                            </div>
                            <div class="divider-custom-line"></div>
                        </div>
                        <!-- Portfolio Modal - Image-->

                        <div class="w3-container">
                            <div class="w3-mySlides">
                                <div class="w3-numbertext">1 / <?= !$images ?: count($images)+1; ?></div>
                                <img class="w-100 border rounded" src="<?= BASE_URL; ?>/<?= $project['image']; ?>">
                            </div>
                            <?php if ($images): ?>
                            <?php $i=1; foreach ($images as $key => $image): $i++; ?>
                            <div class="w3-mySlides">
                                <div class="w3-numbertext"><?= $i ?> / <?= !$images ?: count($images)+1; ?></div>
                                <img class="w-100 border rounded" src="<?= BASE_URL; ?>/<?= $image['image']; ?>">
                            </div>
                            <?php endforeach ?>
                            <?php endif ?>

                            <a class="w3-prev start-0" onclick="plusSlides(-1)">❮</a>
                            <a class="w3-next" onclick="plusSlides(1)">❯</a>


                            <div class="w3-row d-flex justify-content-center">
                                <div class="w3-column">
                                    <img class="w3-demo w3-cursor w-100" src="<?= BASE_URL; ?>/<?= $project['image']; ?>" onclick="currentSlide(1)">
                                </div>
                                <?php if ($images): $i=1 ?>
                                <?php foreach ($images as $key => $image): $i++; ?>
                                <div class="w3-column">
                                    <img class="w3-demo w3-cursor w-100" src="<?= BASE_URL; ?>/<?= $image['image']; ?>" onclick="currentSlide(<?= $i; ?>)">
                                </div>
                                <?php endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>


                        <!-- Portfolio Modal - Text-->
                        <p class="mb-4"><?= $project['description']; ?></p>
                        <a href="<?= $project['source']; ?>" class="btn btn-secondary" target="_blank">
                            <svg style="width: 1em; height: 1em; fill:#fff;">
                                <use xlink:href="#icon-github"></use>
                            </svg>
                            Source
                        </a>
                        <a href="<?= $project['preview']; ?>" class="btn btn-secondary" href="<?= $project['preview'] ?>" target="_blank">
                            <svg style="width: 1em; height: 1em; fill:#fff;">
                                <use xlink:href="#icon-preview"></use>
                            </svg>
                            Preview
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="<?= BASE_URL ?>/public/js/w3-slider.js"></script>
<?php view('footer', ['socials' => $socials, 'site' => $site]); ?>