@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp

<div class="sidebar" id="sidebar">
                <div class="sidebar-header">
                    <div class="sidebar-logo">
                        <a href="index.html">
                        <img src="assets/img/logo.png" class="img-fluid logo" alt>
                        </a>
                        <a href="index.html">
                        <img src="assets/img/logo-small.png" class="img-fluid logo-small" alt>
                        </a>
                    </div>
                </div>
                <div class="sidebar-inner slimscroll">
                    <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li  class="{{ ($route == 'admin.dashboard')?'active':'' }}">
                           <a href="{{ route('admin.dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                        </li>
                     </ul>
                     
                     <ul>
                     <li  class="{{ ($route == 'category.view')?'active':'' }}">
                           <a href="{{ route('category.view') }}"><i class="fe fe-book"></i> <span>Category</span></a>
                        </li>
                     </ul>
                     
                     <ul>
                     <li  class="{{ ($route == 'subcategory.view')?'active':'' }}">
                           <a href="{{ route('subcategory.view') }}"><i class="fe fe-send"></i> <span>Sub category</span></a>
                        </li>
                     </ul>



                        <ul>
                            <li>
                                <a href="{{ route('instructor.view')}}"><i class="fe fe-users"></i> <span>Manage Instructor</span></a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                                <a href="{{ route('load.course.view')}}"><i class="fe fe-file"></i> <span>Courses</span></a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                                <a href="{{ route('admin.view.coupon') }}"><i class="fe fe-package"></i> <span>Coupons</span></a>
                            </li>
                        </ul>


                        <ul>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-settings"></i> <span>Settings</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="{{ route('smtp.setting') }}">Manage SMTP</a></li>
                                    <li><a href="#">Invoice Templates</a></li>
                                </ul>
                            </li>
                        </ul>

                        <ul>
                            <li class="menu-title"><span>Purchases</span></li>
                            <li>
                                <a href="purchases.html"><i class="fe fe-shopping-cart"></i> <span>Purchases</span></a>
                            </li>
                            <li>
                                <a href="purchase-orders.html"><i class="fe fe-shopping-bag"></i> <span>Purchase Orders</span></a>
                            </li>
                            <li>
                                <a href="debit-notes.html"><i class="fe fe-file-text"></i> <span>Debit Notes</span></a>
                            </li>
                        </ul>
                        <ul>
                            <li class="menu-title"><span>Finance & Accounts</span></li>
                            <li>
                                <a href="expenses.html"><i class="fe fe-file-plus"></i> <span>Expenses</span></a>
                            </li>
                            <li>
                                <a href="payments.html"><i class="fe fe-credit-card"></i> <span>Payments</span></a>
                            </li>
                        </ul>
                        <ul>
                            <li class="menu-title"><span>Quotations</span></li>
                            <li>
                                <a href="quotations.html"><i class="fe fe-clipboard"></i> <span>Quotations</span></a>
                            </li>
                            <li>
                                <a href="delivery-challans.html"><i class="fe fe-file-text"></i> <span>Delivery Challans</span></a>
                            </li>
                        </ul>
                        <ul>
                            <li class="menu-title"><span>Reports</span></li>
                            <li>
                                <a href="quotations.html"><i class="fe fe-clipboard"></i> <span>Quotations</span></a>
                            </li>
                            <li>
                                <a href="payment-summary.html"><i class="fe fe-credit-card"></i> <span>Payment Summary</span></a>
                            </li>
                        </ul>
                        <ul>
                            <li class="menu-title"><span>User Management</span></li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-user"></i> <span> Manage Users</span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="add-user.html">Add User</a></li>
                                    <li><a href="users.html">Users</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="roles-permission.html"><i class="fe fe-clipboard"></i> <span>Roles & Permission</span></a>
                            </li>
                            <li>
                                <a href="delete-account-request.html"><i class="fe fe-trash-2"></i> <span>Delete Account Request</span></a>
                            </li>
                        </ul>
                        <ul>
                            <li class="menu-title"><span>Membership</span></li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-book"></i> <span> Membership</span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="membership-plans.html">Membership Plans</a></li>
                                    <li><a href="membership-addons.html">Membership Addons</a></li>
                                    <li><a href="subscribers.html">Subscribers</a></li>
                                    <li><a href="transactions.html">Transactions</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul>
                            <li class="menu-title"><span>Content (CMS)</span></li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-folder"></i> <span> Pages</span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="add-page.html">Add Page</a></li>
                                    <li><a href="pages.html">Pages</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-book"></i> <span> Blog</span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="all-blogs.html">All Blogs</a></li>
                                    <li><a href="add-blog.html">Add Blog</a></li>
                                    <li><a href="categories.html">Categories</a></li>
                                    <li><a href="blog-comments.html">Blog Comments</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-map-pin"></i> <span> Location</span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="countries.html">Countries</a></li>
                                    <li><a href="states.html">States</a></li>
                                    <li><a href="cities.html">Cities</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="testimonials.html"><i class="fe fe-message-square"></i> <span>Testimonials</span></a>
                            </li>
                            <li>
                                <a href="faq.html"><i class="fe fe-alert-circle"></i> <span>FAQ</span></a>
                            </li>
                        </ul>
                        <ul>
                            <li class="menu-title"><span>Support</span></li>
                            <li>
                                <a href="contact-messages.html"><i class="fe fe-printer"></i> <span>Contact Messages</span></a>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-save"></i> <span> Tickets</span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="tickets.html">Tickets</a></li>
                                    <li><a href="tickets-list.html">Tickets List</a></li>
                                    <li><a href="tickets-kanban.html">Tickets Kanban</a></li>
                                    <li><a href="ticket-details.html">Ticket Overview</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-lock"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="login.html"> Login </a></li>
                                    <li><a href="register.html"> Register </a></li>
                                    <li><a href="forgot-password.html"> Forgot Password </a></li>
                                    <li><a href="lock-screen.html"> Lock Screen </a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul>
                            <li class="menu-title"><span>Pages</span></li>
                            <li>
                                <a href="profile.html"><i class="fe fe-user"></i> <span>Profile</span></a>
                            </li>
                            <li>
                                <a href="error-404.html"><i class="fe fe-x-square"></i> <span>Error Pages</span></a>
                            </li>
                            <li>
                                <a href="blank-page.html"><i class="fe fe-file"></i> <span>Blank Page</span></a>
                            </li>
                            <li>
                                <a href="maps-vector.html"><i class="fe fe-image"></i> <span>Vector Maps</span></a>
                            </li>
                        </ul>
                        <ul>
                            <li class="menu-title">
                                <span>UI Interface</span>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-pocket"></i> <span>Base UI </span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="alerts.html">Alerts</a></li>
                                    <li><a href="accordions.html">Accordions</a></li>
                                    <li><a href="avatar.html">Avatar</a></li>
                                    <li><a href="badges.html">Badges</a></li>
                                    <li><a href="buttons.html">Buttons</a></li>
                                    <li><a href="buttongroup.html">Button Group</a></li>
                                    <li><a href="breadcrumbs.html">Breadcrumb</a></li>
                                    <li><a href="cards.html">Cards</a></li>
                                    <li><a href="carousel.html">Carousel</a></li>
                                    <li><a href="dropdowns.html">Dropdowns</a></li>
                                    <li><a href="grid.html">Grid</a></li>
                                    <li><a href="images.html">Images</a></li>
                                    <li><a href="lightbox.html">Lightbox</a></li>
                                    <li><a href="media.html">Media</a></li>
                                    <li><a href="modal.html">Modals</a></li>
                                    <li><a href="offcanvas.html">Offcanvas</a></li>
                                    <li><a href="pagination.html">Pagination</a></li>
                                    <li><a href="popover.html">Popover</a></li>
                                    <li><a href="progress.html">Progress Bars</a></li>
                                    <li><a href="placeholders.html">Placeholders</a></li>
                                    <li><a href="rangeslider.html">Range Slider</a></li>
                                    <li><a href="spinners.html">Spinner</a></li>
                                    <li><a href="sweetalerts.html">Sweet Alerts</a></li>
                                    <li><a href="tab.html">Tabs</a></li>
                                    <li><a href="toastr.html">Toasts</a></li>
                                    <li><a href="tooltip.html">Tooltip</a></li>
                                    <li><a href="typography.html">Typography</a></li>
                                    <li><a href="video.html">Video</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-box"></i> <span>Elements </span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="ribbon.html">Ribbon</a></li>
                                    <li><a href="clipboard.html">Clipboard</a></li>
                                    <li><a href="drag-drop.html">Drag & Drop</a></li>
                                    <li><a href="rating.html">Rating</a></li>
                                    <li><a href="text-editor.html">Text Editor</a></li>
                                    <li><a href="counter.html">Counter</a></li>
                                    <li><a href="scrollbar.html">Scrollbar</a></li>
                                    <li><a href="notification.html">Notification</a></li>
                                    <li><a href="stickynote.html">Sticky Note</a></li>
                                    <li><a href="timeline.html">Timeline</a></li>
                                    <li><a href="horizontal-timeline.html">Horizontal Timeline</a></li>
                                    <li><a href="form-wizard.html">Form Wizard</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-bar-chart"></i> <span> Charts </span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="chart-apex.html">Apex Charts</a></li>
                                    <li><a href="chart-js.html">Chart Js</a></li>
                                    <li><a href="chart-morris.html">Morris Charts</a></li>
                                    <li><a href="chart-flot.html">Flot Charts</a></li>
                                    <li><a href="chart-peity.html">Peity Charts</a></li>
                                    <li><a href="chart-c3.html">C3 Charts</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-award"></i> <span> Icons </span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="icon-fontawesome.html">Fontawesome Icons</a></li>
                                    <li><a href="icon-feather.html">Feather Icons</a></li>
                                    <li><a href="icon-ionic.html">Ionic Icons</a></li>
                                    <li><a href="icon-material.html">Material Icons</a></li>
                                    <li><a href="icon-pe7.html">Pe7 Icons</a></li>
                                    <li><a href="icon-simpleline.html">Simpleline Icons</a></li>
                                    <li><a href="icon-themify.html">Themify Icons</a></li>
                                    <li><a href="icon-weather.html">Weather Icons</a></li>
                                    <li><a href="icon-typicon.html">Typicon Icons</a></li>
                                    <li><a href="icon-flag.html">Flag Icons</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-sidebar"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="form-basic-inputs.html">Basic Inputs </a></li>
                                    <li><a href="form-input-groups.html">Input Groups </a></li>
                                    <li><a href="form-horizontal.html">Horizontal Form </a></li>
                                    <li><a href="form-vertical.html"> Vertical Form </a></li>
                                    <li><a href="form-mask.html">Form Mask </a></li>
                                    <li><a href="form-validation.html">Form Validation </a></li>
                                    <li><a href="form-select2.html">Form Select2 </a></li>
                                    <li><a href="form-fileupload.html">File Upload </a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#"><i class="fe fe-layout"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="tables-basic.html">Basic Tables </a></li>
                                    <li><a href="data-tables.html">Data Table </a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul>
                            <li class="menu-title"><span>Settings</span></li>
                            <li>
                                <a href="settings.html"><i class="fe fe-settings"></i> <span>Settings</span></a>
                            </li>
                            <li>
                                <a href="login.html"><i class="fe fe-power"></i> <span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>