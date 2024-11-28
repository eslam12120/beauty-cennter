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
                                <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
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
                                <i class="la la-tag"></i>
                                <span class="menu-title" data-i18n="nav.dash.main">Categories</span>
                                <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
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


                  <li class="nav-item">
                     <a href="">
                            <i class="la la-tag"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">Notifications</span>
                            <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                   {{ App\Models\Notification::count() }}
                            </span>
                     </a>
                     <ul class="menu-content">
                            <li>
                                   <a class="menu-item" href="{{ route('notification.create') }}" data-i18n="nav.dash.crypto">Send New Notification</a>
                            </li>
                     </ul>
              </li>


                  <li class="nav-item">
                     <a href="">
                            <i class="la la-group"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">Banners</span>
                            <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                   {{ App\Models\SpecialForYou::count() }}
                            </span>
                     </a>
                     <ul class="menu-content">
                            <li>
                                   <a class="menu-item" href="{{ route('admin.banners.index') }}" data-i18n="nav.dash.ecommerce">All Banners</a>
                            </li>
                            <li>
                                   <a class="menu-item" href="{{ route('admin.banners.create') }}" data-i18n="nav.dash.crypto">Add Banner</a>
                            </li>
                     </ul>
              </li>

                  <!-- New Services Section -->
                  <li class="nav-item">
                         <a href="">
                                <i class="la la-cogs"></i> <!-- Add appropriate icon for services -->
                                <span class="menu-title" data-i18n="nav.dash.main">Services</span>
                                <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                       {{ App\Models\service::count() }} <!-- Count the number of services -->
                                </span>
                         </a>
                         <ul class="menu-content">
                                <li>
                                       <a class="menu-item" href="{{ route('services.index') }}" data-i18n="nav.dash.ecommerce">All Services</a>
                                </li>
                                <li>
                                       <a class="menu-item" href="{{ route('services.create') }}" data-i18n="nav.dash.crypto">Add New Service</a>
                                </li>
                         </ul>
                  </li>

                  <li class="nav-item">
                         <a href="">
                                <i class="la la-user-md"></i> <!-- Use an appropriate icon for specialists -->
                                <span class="menu-title" data-i18n="nav.dash.main">Specialists</span>
                                <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
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


                  <!-- New Times Section -->
                  <li class="nav-item">
                         <a href="">
                                <i class="la la-cogs"></i> <!-- Add appropriate icon for services -->
                                <span class="menu-title" data-i18n="nav.dash.main">Times</span>
                               <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
 {{ App\Models\Time::count() }} <!-- Count the number of services -->
</span>

                         </a>
                         <ul class="menu-content">
                                <li>
                                       <a class="menu-item" href="{{ route('time.index') }}" data-i18n="nav.dash.ecommerce">Times</a>
                                </li>

                         </ul>
                  </li>
                  <!-- New specialist Time Section -->
                  <li class="nav-item">
                         <a href="">
                                <i class="la la-cogs"></i> <!-- Icon for time management -->
                                <span class="menu-title" data-i18n="nav.dash.main">Specialist Time</span>
                                <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                       {{ App\Models\TimeSpecialist::count() }} <!-- Adjust the model name if needed -->
                                </span>
                         </a>
                         <ul class="menu-content">
                                <li>
                                       <a class="menu-item" href="{{ route('schedule.index') }}" data-i18n="nav.dash.ecommerce">All Specialist Times</a>
                                </li>
                                <li>
                                       <a class="menu-item" href="{{ route('schedule.create') }}" data-i18n="nav.dash.crypto">Add Specialist Time</a>
                                </li>
                         </ul>
                  </li>
                  <!-- New Booking Section -->
                  <li class="nav-item">
                         <a href="">
                                <i class="la la-cogs"></i> <!-- Add appropriate icon for services -->
                                <span class="menu-title" data-i18n="nav.dash.main">Booking</span>
                                <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                       {{ App\Models\Booking::count() }} <!-- Count the number of services -->
                                </span>
                         </a>
                         <ul class="menu-content">
                                <li>
                                       <a class="menu-item" href="{{ route('bookings.index') }}" data-i18n="nav.dash.ecommerce">Booking List</a>
                                </li>

                         </ul>
                  </li>
                  <!-- New Questions Section -->
                  <li class="nav-item">
                         <a href="">
                                <i class="la la-cogs"></i> <!-- Add appropriate icon for services -->
                                <span class="menu-title" data-i18n="nav.dash.main">Questions</span>
                                <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                       {{ App\Models\Question::count() }} <!-- Count the number of services -->
                                </span>
                         </a>
                         <ul class="menu-content">
                                <li>
                                       <a class="menu-item" href="{{ route('question.index') }}" data-i18n="nav.dash.ecommerce">Question & Answers</a>
                                </li>
                                <li>
                                       <a class="menu-item" href="{{ route('question.create') }}" data-i18n="nav.dash.crypto">Add New Question</a>
                                </li>

                         </ul>
                  </li>
                  <!-- New Contacts Section -->
                  <li class="nav-item">
                         <a href="">
                                <i class="la la-cogs"></i> <!-- Add appropriate icon for services -->
                                <span class="menu-title" data-i18n="nav.dash.main">Contacts</span>
                                <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                       {{ App\Models\ContactUs::count() }} <!-- Count the number of services -->
                                </span>
                         </a>
                         <ul class="menu-content">
                                <li>
                                       <a class="menu-item" href="{{ route('contact.index') }}" data-i18n="nav.dash.ecommerce">Contact Us</a>
                                </li>
                                <li>
                                       <a class="menu-item" href="{{ route('contact.create') }}" data-i18n="nav.dash.crypto">Add New Contact Us</a>
                                </li>

                         </ul>
                  </li>

                  <!-- New Feedback Section -->
                  <li class="nav-item">
                         <a href="">
                                <i class="la la-comments"></i>
                                <span class="menu-title" data-i18n="nav.dash.main">Feedback</span>
                                <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
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
