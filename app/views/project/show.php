<?php view('header'); ?>
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
                                <svg style="width: 1.125em; fill: #2c3e50;     vertical-align: -0.125em;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
                            </div>
                            <div class="divider-custom-line"></div>
                        </div>
                        <!-- Portfolio Modal - Image-->
                        <!-- <img class="img-fluid rounded mb-5 border" src="<?= BASE_URL; ?>/<?= $project['image']; ?>" alt="..." /> -->

                        <div class="w3-container">
                            <div class="w3-mySlides">
                                <div class="w3-numbertext">1 / 6</div>
                                <img class="w-100 border rounded" src="<?= BASE_URL; ?>/<?= $project['image']; ?>">
                            </div>
                            <?php if ($images): ?>
                            <?php foreach ($images as $key => $image): ?>
                            <div class="w3-mySlides">
                                <div class="w3-numbertext">1 / 6</div>
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
                            <svg style="width: 1em; fill:#fff;" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path></svg>
                            Source
                        </a>
                        <a href="<?= $project['preview']; ?>" class="btn btn-secondary" href="<?= $project['preview'] ?>" target="_blank">
                            <svg style="width: 1em; fill:#fff;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M314.222 197.78c51.091 51.091 54.377 132.287 9.75 187.16-6.242 7.73-2.784 3.865-84.94 86.02-54.696 54.696-143.266 54.745-197.99 0-54.711-54.69-54.734-143.255 0-197.99 32.773-32.773 51.835-51.899 63.409-63.457 7.463-7.452 20.331-2.354 20.486 8.192a173.31 173.31 0 0 0 4.746 37.828c.966 4.029-.272 8.269-3.202 11.198L80.632 312.57c-32.755 32.775-32.887 85.892 0 118.8 32.775 32.755 85.892 32.887 118.8 0l75.19-75.2c32.718-32.725 32.777-86.013 0-118.79a83.722 83.722 0 0 0-22.814-16.229c-4.623-2.233-7.182-7.25-6.561-12.346 1.356-11.122 6.296-21.885 14.815-30.405l4.375-4.375c3.625-3.626 9.177-4.594 13.76-2.294 12.999 6.524 25.187 15.211 36.025 26.049zM470.958 41.04c-54.724-54.745-143.294-54.696-197.99 0-82.156 82.156-78.698 78.29-84.94 86.02-44.627 54.873-41.341 136.069 9.75 187.16 10.838 10.838 23.026 19.525 36.025 26.049 4.582 2.3 10.134 1.331 13.76-2.294l4.375-4.375c8.52-8.519 13.459-19.283 14.815-30.405.621-5.096-1.938-10.113-6.561-12.346a83.706 83.706 0 0 1-22.814-16.229c-32.777-32.777-32.718-86.065 0-118.79l75.19-75.2c32.908-32.887 86.025-32.755 118.8 0 32.887 32.908 32.755 86.025 0 118.8l-45.848 45.84c-2.93 2.929-4.168 7.169-3.202 11.198a173.31 173.31 0 0 1 4.746 37.828c.155 10.546 13.023 15.644 20.486 8.192 11.574-11.558 30.636-30.684 63.409-63.457 54.733-54.735 54.71-143.3-.001-197.991z"/></svg>
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
<?php view('footer', ['socials' => $socials]); ?>