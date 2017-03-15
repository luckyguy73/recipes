<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>Tags</h4>
            <ol class="list-unstyled">
              @foreach ($tags as $tag)
                <li><a href="/posts/tags/{{ $tag }}">{{ $tag }}</a></li>
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
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->
