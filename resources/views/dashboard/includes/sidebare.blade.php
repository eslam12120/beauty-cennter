<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
       <div class="main-menu-content">
              <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                     <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}">
                                   <i class=""></i>
                                   <span class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية</span>
                            </a>
                     </li>

                     <li class="nav-item">
                            <a href="">
                                   <i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">العملاء</span>
                                   <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                          {{ App\Models\User::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li>
                                          <a class="menu-item" href="{{ route('admin.users.index') }}" data-i18n="nav.dash.ecommerce">كل العملاء</a>
                                   </li>
                                   <li>
                                          <a class="menu-item" href="{{ route('admin.users.create') }}" data-i18n="nav.dash.crypto">إضافة عميل</a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item">
                            <a href="">
                                   <i class="la la-tag"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">الفئات</span>
                                   <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                          {{ App\Models\Category::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li>
                                          <a class="menu-item" href="{{ route('category.index') }}" data-i18n="nav.dash.ecommerce">كل الفئات</a>
                                   </li>
                                   <li>
                                          <a class="menu-item" href="{{ route('category.create') }}" data-i18n="nav.dash.crypto">إضافة فئة جديدة</a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item">
                        <a href="">
                               <i class="la la-tag"></i>
                               <span class="menu-title" data-i18n="nav.dash.main">الإشعارات</span>
                               <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                      {{ App\Models\Notification::count() }}
                               </span>
                        </a>
                        <ul class="menu-content">
                               <li>
                                      <a class="menu-item" href="{{ route('notification.create') }}" data-i18n="nav.dash.crypto">إرسال إشعار جديد</a>
                               </li>
                        </ul>
                 </li>

                     <li class="nav-item">
                        <a href="">
                               <i class="la la-group"></i>
                               <span class="menu-title" data-i18n="nav.dash.main">اللافتات</span>
                               <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                      {{ App\Models\SpecialForYou::count() }}
                               </span>
                        </a>
                        <ul class="menu-content">
                               <li>
                                      <a class="menu-item" href="{{ route('admin.banners.index') }}" data-i18n="nav.dash.ecommerce">كل اللافتات</a>
                               </li>
                               <li>
                                      <a class="menu-item" href="{{ route('admin.banners.create') }}" data-i18n="nav.dash.crypto">إضافة لافتة</a>
                               </li>
                        </ul>
                 </li>

                     <li class="nav-item">
                            <a href="">
                                   <i class="la la-cogs"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">الخدمات</span>
                                   <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                          {{ App\Models\service::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li>
                                          <a class="menu-item" href="{{ route('services.index') }}" data-i18n="nav.dash.ecommerce">كل الخدمات</a>
                                   </li>
                                   <li>
                                          <a class="menu-item" href="{{ route('services.create') }}" data-i18n="nav.dash.crypto">إضافة خدمة جديدة</a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item">
                            <a href="">
                                   <i class="la la-user-md"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">المتخصصون</span>
                                   <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                          {{ App\Models\Specialist::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li>
                                          <a class="menu-item" href="{{ route('specialist.index') }}" data-i18n="nav.dash.ecommerce">كل المتخصصين</a>
                                   </li>
                                   <li>
                                          <a class="menu-item" href="{{ route('specialist.create') }}" data-i18n="nav.dash.crypto">إضافة متخصص</a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item">
                            <a href="">
                                   <i class="la la-cogs"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">مواعيد العمل </span>
                                   <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                          {{ App\Models\Time::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li>
                                          <a class="menu-item" href="{{ route('time.index') }}" data-i18n="nav.dash.ecommerce">مواعيد العمل </a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item">
                            <a href="">
                                   <i class="la la-cogs"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">أوقات المتخصصين</span>
                                   <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                          {{ App\Models\TimeSpecialist::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li>
                                          <a class="menu-item" href="{{ route('schedule.index') }}" data-i18n="nav.dash.ecommerce">كل الأوقات</a>
                                   </li>
                                   <li>
                                          <a class="menu-item" href="{{ route('schedule.create') }}" data-i18n="nav.dash.crypto">إضافة وقت جديد</a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item">
                            <a href="">
                                   <i class="la la-cogs"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">الحجوزات</span>
                                   <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                          {{ App\Models\Booking::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li>
                                          <a class="menu-item" href="{{ route('bookings.index') }}" data-i18n="nav.dash.ecommerce">قائمة الحجوزات</a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item">
                            <a href="">
                                   <i class="la la-cogs"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">الأسئلة</span>
                                   <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                          {{ App\Models\Question::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li>
                                          <a class="menu-item" href="{{ route('question.index') }}" data-i18n="nav.dash.ecommerce">الأسئلة والإجابات</a>
                                   </li>
                                   <li>
                                          <a class="menu-item" href="{{ route('question.create') }}" data-i18n="nav.dash.crypto">إضافة سؤال جديد</a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item">
                            <a href="">
                                   <i class="la la-cogs"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">التواصل</span>
                                   <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
                                          {{ App\Models\ContactUs::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li>
                                          <a class="menu-item" href="{{ route('contact.index') }}" data-i18n="nav.dash.ecommerce">التواصل</a>
                                   </li>
                                     <li>
                                          <a class="menu-item" href="{{ route('contact.create') }}" data-i18n="nav.dash.ecommerce">اضافة تواصل </a>
                                   </li>
                            </ul>
                     </li>
                     
                     <li class="nav-item">
    <a href="">
        <i class="la la-comment"></i>
        <span class="menu-title" data-i18n="nav.dash.main">التعليقات</span>
        <span class="badge badge-pill float-right mr-2" style="background-color: #8F635A; color: white;">
            {{ App\Models\UserFeedback::count() }}
        </span>
    </a>
    <ul class="menu-content">
        <li>
            <a class="menu-item" href="{{ route('feedback.index') }}" data-i18n="nav.dash.ecommerce">كل التعليقات</a>
        </li>
       
    </ul>
</li>

              </ul>
              
       </div>
</div>
