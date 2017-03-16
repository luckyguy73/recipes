<div class="col-sm-2 col-sm-offset-1 blog-sidebar text-center">
          <div class="sidebar-module sidebar-module-inset">
            <h4>Tags</h4>
            <ol class="list-unstyled">
              @foreach ($tags as $tag)
                <li><a href="/posts/tags/{{ $tag->name }}">{{ $tag->name }}</a></li>
              @endforeach
            </ol>
          </div>
          <div class="sidebar-module sidebar-module-inset">
            <h4>Archives</h4>
            <ol class="list-unstyled">
              @foreach ($archives as $stats)
                <li><a href="/posts?month={{ $stats['month'] }}&year={{ $stats['year'] }}">{{ $stats['month'] . ' ' . $stats['year'] }}</a></li>
              @endforeach
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->
