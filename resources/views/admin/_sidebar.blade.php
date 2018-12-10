<ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Админ-панель</span>
          </a>
        </li>
        <li><a href="{{route('posts.index')}}"><i class="fa fa-sticky-note-o"></i> <span>Посты</span></a></li>
        <li><a href="{{route('categories.index')}}"><i class="fa fa-list-ul"></i> <span>Категории</span></a></li>
        <li><a href="{{route('tags.index')}}"><i class="fa fa-tags"></i> <span>Теги</span></a></li>
        <li>
          <a href="{{route('comments')}}">
            <i class="fa fa-commenting"></i> <span>Комментарии</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">{{
                $comments_count}}</small>
            </span>
          </a>
        </li>
      <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> <span>Пользователи</span></a></li>
        <li><a href="#"><i class="fa fa-user-plus"></i> <span>Подписчики</span></a></li>
      
      </ul>