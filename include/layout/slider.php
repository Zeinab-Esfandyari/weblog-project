<?php
$sliders = $db->query("SELECT * FROM posts_slider");
?>

<!-- Modern Blog Slider -->
<section class="blog-slider-section mb-4">
    <div id="carousel" class="carousel slide blog-carousel">

        <div class="carousel-indicators">
            <?php $sliderItems = $sliders->fetchAll(PDO::FETCH_ASSOC); ?>

            <?php foreach ($sliderItems as $index => $sliderItem): ?>
            <button type="button" data-bs-target="#carousel"
                data-bs-slide-to="<?= $index ?>"
                class="<?= !empty($sliderItem['active']) ? 'active' : '' ?>"
                aria-label="اسلاید <?= $index + 1 ?>">
            </button>
            <?php endforeach ?>
        </div>

        <div class="carousel-inner rounded-4 overflow-hidden">

            <?php if (count($sliderItems) > 0) : ?>

            <?php foreach ($sliderItems as $slider) : ?>

            <?php
                    $postId = $slider['post_id'];
                $post = $db->query("SELECT * FROM posts WHERE id = $postId")->fetch();
                ?>

            <div
                class="carousel-item overlay carousel-height blog-carousel-item <?= $slider['active'] ? 'active' : ''; ?>">

                <img src="./uploads/posts/<?= $post['image'] ?>"
                    class="d-block w-100 blog-carousel-image"
                    alt="<?= $post['title']; ?>" />

                <div class="carousel-caption blog-carousel-caption">
                    <div class="carousel-caption-content">
                        <span class="slider-label">
                            مطالب منتخب وبلاگ
                        </span>

                        <h2 class="slider-title">
                            <?= $post['title']; ?>
                        </h2>

                        <p class="slider-description">
                            <?= substr($post['body'], 0, 200) . "..." ?>
                        </p>

                        <a href="single.php?id=<?= $postId ?>"
                            class="slider-read-more">
                            <!-- <i class="bi bi-arrow-left"></i> -->
                        </a>
                    </div>
                </div>

            </div>

            <?php endforeach ?>

            <?php endif ?>

        </div>

        <button class="carousel-control-prev blog-carousel-control" type="button" data-bs-target="#carousel"
            data-bs-slide="prev">

            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next blog-carousel-control" type="button" data-bs-target="#carousel"
            data-bs-slide="next">

            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>
</section>