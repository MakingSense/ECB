<?php
	/**
	 * @param is-padded checkbox 0
	 */

	// prevention for old version of this plugin, @deprecated since 1.1
	$isPadded = false;
	if(isset($template_variables['is-padded']) && $template_variables['is-padded']) {
		$isPadded = true;
	}

	class Featured {
    public function __construct($instance, $entries) {
			$this->title = $instance['title'];
			$this->caller = $instance['caller'];
			$this->isContentVisible = $raw->show_page_content;
			$this->posts = $this->loadFeaturedPosts($entries);;
		}

		private function loadFeaturedPosts ($rawentries) {
			$posts = [];
			if (isset($rawentries)) {
				foreach ($rawentries as $key => $rawentry) {
					$post = new FeaturedPost($rawentry);
					array_push($posts, $post);
				}
			}
			return $posts;
		}
	}

	class FeaturedPost {
		function __construct($raw) {
			$this->title = $raw['title'];
			$this->link = $raw['link'];
			$this->image = $raw['link_thumbnail'];
			$this->category = $raw['cat'];
			$this->date = $raw['date'];
			$this->content = $raw['content'];
		}
	}

	$featured = new Featured($instance, $entries);
?>


<?php if(count($featured->posts) > 0) : ?>

	<section class="component--featured">
		<?php if($featured->title && $caller === 'shortcode') : ?>
			<h2><?= $featured->title ?></h2>
		<?php endif; ?>

		<div class="article-wrapper">

			<section class="article-container desktop-only">
				<?php foreach ($featured->posts as $post) : ?>
					<article class="article featured">
						<div class="wrapper">
							<a
								class="text"
								style="background-image: url(<?= $post->image ?>);"
								href="<?= $post->link ?>">
								<h2><?= $post->category ?></h2>
								<h3><?= $post->title ?></h3>
								<h4><?= $post->date ?></h4>
							</a>
						</div>
					</article>
				<?php endforeach; ?>
			</section>

			<section class="article-container mobile-only owl-carousel">
				<?php foreach ($featured->posts as $post) : ?>
					<article class="article featured">
						<div class="wrapper">
							<a
								class="text"
								style="background-image: url(<?= $post->image ?>);"
								href="<?= $post->link ?>">
								<h2><?= $post->category ?></h2>
								<h3><?= $post->title ?></h3>
								<h4><?= $post->date ?></h4>
							</a>
						</div>
					</article>
				<?php endforeach; ?>
			</section>

		</div>
	</section>
<?php endif; ?>
