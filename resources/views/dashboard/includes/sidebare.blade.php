<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
       <div class="main-menu-content">
              <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                     <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}">
                                   <i class=""></i>
                                   <span class="menu-title" data-i18n="nav.add_on_drag_drop.main">Home</span>
                            </a>
                     </li>

                     <li class="nav-item">
                            <a href="">
                                   <i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">Clients</span>
                                   <span class="badge badge-danger badge-pill float-right mr-2">
                                          {{ App\Models\User::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li>
                                          <a class="menu-item" href="{{ route('admin.users.index') }}" data-i18n="nav.dash.ecommerce">All Clients</a>
                                   </li>
                                   <li>
                                          <a class="menu-item" href="{{ route('admin.users.create') }}" data-i18n="nav.dash.crypto">Add Client</a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item">
                            <a href="">
                                   <i class="la la-user-md"></i> <!-- Use an appropriate icon for specialists -->
                                   <span class="menu-title" data-i18n="nav.dash.main">Specialists</span>
                                   <span class="badge badge-danger badge-pill float-right mr-2">
                                          {{ App\Models\Specialist::count() }} <!-- Adjust the model if needed -->
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li>
                                          <a class="menu-item" href="{{ route('specialist.index') }}" data-i18n="nav.dash.ecommerce">All Specialists</a>
                                   </li>
                                   <li>
                                          <a class="menu-item" href="{{ route('specialist.create') }}" data-i18n="nav.dash.crypto">Add Specialist</a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item">
                            <a href="">
                                   <i class="la la-tag"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">Categories</span>
                                   <span class="badge badge-danger badge-pill float-right mr-2">
                                          {{ App\Models\Category::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li>
                                          <a class="menu-item" href="{{ route('category.index') }}" data-i18n="nav.dash.ecommerce">All Categories</a>
                                   </li>
                                   <li>
                                          <a class="menu-item" href="{{ route('category.create') }}" data-i18n="nav.dash.crypto">Add New Category</a>
                                   </li>
                            </ul>
                     </li>

                     <!-- New Feedback Section -->
                     <li class="nav-item">
                            <a href="">
                                   <i class="la la-comments"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">Feedback</span>
                                   <span class="badge badge-danger badge-pill float-right mr-2">
                                          {{ App\Models\UserFeedback::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li>
                                          <a class="menu-item" href="{{ route('feedback.index') }}" data-i18n="nav.dash.feedback">All Feedbacks</a>
                                   </li>
                            </ul>
                     </li>

                     <li class="navigation-header"></li>
              </ul>
       </div>
</div>