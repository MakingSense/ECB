
<?php
/*
Template Name: Page Staff
*/
  get_header();
  wp_reset_postdata();

  class Staff {
    public function __construct(){
      $this->title = get_the_title();
      $this->members = $this->loadMembers();
    }

    private function loadMembers() {
      $members = [];
      $rawMembers = get_field('staff_posts', get_the_ID());
      foreach ($rawMembers as $rawMember) {
        array_push($members, new StaffMember($rawMember));
      }
      return $members;
    }
  }

  class StaffMember {
    public function __construct($raw){
      $this->name = $raw->post_title;
      $this->position = get_field('position', $raw->ID);
      $this->image = get_field('image', $raw->ID);
      $this->description = str_replace(']]>', ']]&gt;', apply_filters('the_content', $raw->post_content));
    }
  }

  $staff = new Staff;
?>

<main role="main" class="section--staff">
  <div class="head">
    <h1><?= $staff->title ?></h1>
  </div>
  <section class="content">
    <?php foreach($staff->members as $member) : ?>
      <article class="member">
        <div class="image"><figure><img src="<?= $member->image ?>" /></figure></div>
        <div class="text">
          <h2><?= $member->name ?></h2>
          <h3><?= $member->position ?></h3>
          <p><?= $member->description ?></p>
        </div>
      </article>
    <?php endforeach; ?>
  </section>
</main>

<?php
  get_footer();
?>
