<?php get_header(); ?>

<?php
// Lấy trang Tin tức theo slug (đổi 'tin-tuc' nếu khác)
$news_page = get_page_by_path('tin-tuc');
$news_title = $news_page ? get_the_title($news_page) : __('Tin tức', 'td');
$news_link = $news_page ? get_permalink($news_page) : home_url('/');

// Post type hiện tại (single hoặc archive)
$current_pt = is_singular() ? get_post_type() : (is_post_type_archive() ? get_query_var('post_type') : '');

// Tên + link archive của CPT (động)
$archive_title = $archive_link = '';
if ($current_pt) {
  if (is_post_type_archive()) {
    $archive_title = post_type_archive_title('', false);
  } else {
    $pto = get_post_type_object($current_pt);
    $archive_title = $pto && !empty($pto->labels->name) ? $pto->labels->name : ucfirst($current_pt);
  }
  $archive_link = get_post_type_archive_link($current_pt);
}

// Build: Tin tức -> CPT (không có tiêu đề bài)
$crumbs = [
  ['label' => $news_title, 'url' => $news_link],
  ['label' => $archive_title, 'url' => is_singular() ? $archive_link : ''],
];
?>

<div class="container pt-5 pb-3">
  <div class="page-meta mt-5">
    <nav class="breadcrumbs" aria-label="Breadcrumb">
      <ol class="bc-list">
        <?php foreach ($crumbs as $c):
          if (!$c['label'])
            continue; ?>
          <li class="bc-item">
            <?php if (!empty($c['url'])): ?>
              <a href="<?php echo esc_url($c['url']); ?>"><?php echo esc_html($c['label']); ?></a>
            <?php else: ?>
              <span aria-current="page"><?php echo esc_html($c['label']); ?></span>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ol>
    </nav>

    <div class="share">
      <span class="share__label">Chia sẻ</span>
      <a class="share__btn is-fb" href="<?php echo esc_url($share_fb); ?>" target="_blank" rel="noopener"
        aria-label="Chia sẻ Facebook">
        <img
          src="data:image/svg+xml;utf8,%3Csvg display='inline-block' color='inherit' width='1em' height='1em' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M17 3.50005C17 3.36745 16.9473 3.24027 16.8536 3.1465C16.7598 3.05273 16.6326 3.00005 16.5 3.00005H14C12.7411 2.93734 11.5086 3.37544 10.5717 4.21863C9.63485 5.06182 9.06978 6.24155 9 7.50005V10.2001H6.5C6.36739 10.2001 6.24021 10.2527 6.14645 10.3465C6.05268 10.4403 6 10.5674 6 10.7001V13.3001C6 13.4327 6.05268 13.5598 6.14645 13.6536C6.24021 13.7474 6.36739 13.8001 6.5 13.8001H9V20.5001C9 20.6327 9.05268 20.7598 9.14645 20.8536C9.24021 20.9474 9.36739 21.0001 9.5 21.0001H12.5C12.6326 21.0001 12.7598 20.9474 12.8536 20.8536C12.9473 20.7598 13 20.6327 13 20.5001V13.8001H15.62C15.7312 13.8017 15.8397 13.7661 15.9285 13.6991C16.0172 13.6321 16.0811 13.5374 16.11 13.4301L16.83 10.8301C16.8499 10.7562 16.8526 10.6787 16.8378 10.6036C16.8231 10.5286 16.7913 10.4579 16.7449 10.397C16.6985 10.3362 16.6388 10.2868 16.5704 10.2526C16.5019 10.2185 16.4265 10.2005 16.35 10.2001H13V7.50005C13.0249 7.25253 13.1411 7.02317 13.326 6.85675C13.5109 6.69033 13.7512 6.59881 14 6.60005H16.5C16.6326 6.60005 16.7598 6.54737 16.8536 6.45361C16.9473 6.35984 17 6.23266 17 6.10005V3.50005Z' fill='white'/%3E%3C/svg%3E"
          alt="">
      </a>
      <a class="share__btn is-tw" href="<?php echo esc_url($share_tw); ?>" target="_blank" rel="noopener"
        aria-label="Chia sẻ Twitter/X">
        <img
          src="data:image/svg+xml;utf8,%3Csvg display='inline-block' color='inherit' width='1em' height='1em' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M8.0798 20.0008C9.55849 20.0503 11.0321 19.8028 12.4135 19.2731C13.795 18.7433 15.0562 17.9421 16.1227 16.9166C17.1892 15.8911 18.0393 14.6623 18.6228 13.3027C19.2062 11.9431 19.5113 10.4803 19.5198 9.00078C20.1974 8.16219 20.7006 7.19661 20.9998 6.16078C21.0221 6.07894 21.0203 5.99239 20.9946 5.91155C20.9689 5.83071 20.9203 5.75903 20.8548 5.70514C20.7893 5.65125 20.7096 5.61745 20.6253 5.6078C20.5411 5.59816 20.4558 5.61308 20.3798 5.65078C20.0253 5.82143 19.6261 5.87655 19.2386 5.80838C18.8511 5.74021 18.4948 5.55218 18.2198 5.27078C17.8687 4.88635 17.4441 4.57631 16.971 4.359C16.498 4.1417 15.9861 4.02156 15.4657 4.00571C14.9454 3.98986 14.4272 4.07861 13.9417 4.26671C13.4563 4.45482 13.0136 4.73844 12.6398 5.10078C12.128 5.59644 11.7531 6.21607 11.5516 6.89945C11.3501 7.58284 11.3288 8.30673 11.4898 9.00078C8.1398 9.20078 5.8398 7.61078 3.9998 5.43078C3.94452 5.36818 3.87221 5.32303 3.7917 5.30085C3.71119 5.27866 3.62596 5.2804 3.54642 5.30586C3.46688 5.33131 3.39648 5.37937 3.3438 5.44417C3.29113 5.50898 3.25846 5.58772 3.2498 5.67078C2.89927 7.6152 3.15213 9.62032 3.97442 11.4168C4.7967 13.2134 6.14904 14.7153 7.8498 15.7208C6.70943 17.0286 5.10801 17.8454 3.3798 18.0008C3.28721 18.0161 3.20174 18.0601 3.13535 18.1264C3.06896 18.1927 3.02497 18.2782 3.00954 18.3707C2.99411 18.4633 3.00801 18.5584 3.0493 18.6427C3.09059 18.727 3.15719 18.7962 3.2398 18.8408C4.74332 19.5921 6.39903 19.989 8.0798 20.0008Z' fill='white'/%3E%3C/svg%3E"
          alt="">
        <a class="share__btn is-in" href="<?php echo esc_url($share_in); ?>" target="_blank" rel="noopener"
          aria-label="Chia sẻ LinkedIn">
          <img
            src="data:image/svg+xml;utf8,%3Csvg display='inline-block' color='inherit' width='1em' height='1em' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M15.1498 8.40042C14.3834 8.39779 13.6239 8.54632 12.9149 8.8375C12.2059 9.12868 11.5613 9.55681 11.018 10.0974C10.4746 10.6379 10.0432 11.2803 9.74837 11.9878C9.45354 12.6953 9.30111 13.454 9.2998 14.2204V20.1004C9.2998 20.3391 9.39463 20.568 9.56341 20.7368C9.73219 20.9056 9.96111 21.0004 10.1998 21.0004H12.2998C12.5385 21.0004 12.7674 20.9056 12.9362 20.7368C13.105 20.568 13.1998 20.3391 13.1998 20.1004V14.2204C13.1996 13.9478 13.2569 13.6782 13.3678 13.4293C13.4788 13.1803 13.641 12.9575 13.8439 12.7754C14.0467 12.5933 14.2857 12.456 14.5452 12.3724C14.8046 12.2889 15.0788 12.2609 15.3498 12.2904C15.8358 12.3516 16.2825 12.5891 16.605 12.9577C16.9276 13.3264 17.1036 13.8006 17.0998 14.2904V20.1004C17.0998 20.3391 17.1946 20.568 17.3634 20.7368C17.5322 20.9056 17.7611 21.0004 17.9998 21.0004H20.0998C20.3385 21.0004 20.5674 20.9056 20.7362 20.7368C20.905 20.568 20.9998 20.3391 20.9998 20.1004V14.2204C20.9985 13.454 20.8461 12.6953 20.5512 11.9878C20.2564 11.2803 19.825 10.6379 19.2816 10.0974C18.7383 9.55681 18.0937 9.12868 17.3847 8.8375C16.6757 8.54632 15.9163 8.39779 15.1498 8.40042Z' fill='white'/%3E%3Cpath d='M6.6 9.30078H3.9C3.40294 9.30078 3 9.70372 3 10.2008V20.1008C3 20.5978 3.40294 21.0008 3.9 21.0008H6.6C7.09706 21.0008 7.5 20.5978 7.5 20.1008V10.2008C7.5 9.70372 7.09706 9.30078 6.6 9.30078Z' fill='white'/%3E%3Cpath d='M5.25 7.5C6.49264 7.5 7.5 6.49264 7.5 5.25C7.5 4.00736 6.49264 3 5.25 3C4.00736 3 3 4.00736 3 5.25C3 6.49264 4.00736 7.5 5.25 7.5Z' fill='white'/%3E%3C/svg%3E"
            alt="">
        </a>
    </div>
  </div>
</div>

<main class="container single-news">
  <?php if (have_posts()):
    while (have_posts()):
      the_post(); ?>
      <article <?php post_class('news-entry'); ?>>
        <header class="news-entry__header">
          <h1 class="news-entry__title"><?php the_title(); ?></h1>
          <div class="news-entry__meta">
            <time class="news-entry__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
              <?php echo esc_html(get_the_date('d/m/Y')); // hoặc get_the_date(get_option('date_format')) ?>
            </time>
          </div>
        </header>

        <div class="news-entry__content">
          <?php
          the_content();
          // Nếu bài có phân trang bằng <!--nextpage-->
          wp_link_pages([
            'before' => '<nav class="post-pages"><span>Trang:</span>',
            'after' => '</nav>',
          ]);
          ?>
        </div>

      </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>