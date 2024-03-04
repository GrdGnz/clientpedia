<?php

use App\Http\Controllers\AccountManagerController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AncilliaryFeeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientBookerController;
use App\Http\Controllers\ClientBookingProcessController;
use App\Http\Controllers\ClientContactController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientFareReferenceController;
use App\Http\Controllers\ClientFeeController;
use App\Http\Controllers\ClientHotelCorporateCodeController;
use App\Http\Controllers\ClientInfoController;
use App\Http\Controllers\ClientInvoiceAttachmentController;
use App\Http\Controllers\ClientPreferredAirlinesController;
use App\Http\Controllers\ClientReportingElementController;
use App\Http\Controllers\ClientTravelPolicyController;
use App\Http\Controllers\ClientTravelSecurityController;
use App\Http\Controllers\ClientVipController;
use App\Http\Controllers\PricingmodelController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\TravelConsultantController;
use App\Http\Controllers\UserClientController;
use App\Http\Controllers\UserController;
use App\Models\ProfilePhoto;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => 'cors'], function () {

    //View PHP info
    Route::get('/phpinfo', function () {
        phpinfo();
    });

    // Define a catch-all route for undefined routes
    Route::fallback(function () {
        return view('errors.403');
    })->name('fallback');

    Route::get('/', function () {
        return redirect()->route('login'); // Redirect to the login page
    });

    // Authentication routes
    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //User Settings
    Route::get('profile', function () {
        // Get user's last login date
        $user = Auth::user();
        $userActivity = new UserActivity;
        $lastLoginDate = $userActivity->getLastLoginDate($user->id);

        $profile_photo = ProfilePhoto::find($user->id);

        return view('layouts.settings', compact('lastLoginDate', 'profile_photo'));
    })->name('profile');
    // Update User Profile
    Route::post('update-profile', [UserController::class, 'updateProfile'])->name('user.update-profile');
    // Trigger Password Reset Email
    Route::post('send-password-reset-email', [UserController::class, 'sendPasswordResetEmail'])->name('user.password.email');

    // Travel Consultant routes
    Route::middleware(['auth', 'checkUserRole:2'])->group(function () {
        Route::controller(TravelConsultantController::class)->group(function () {
            // ... Your Travel Consultant routes ...
            Route::get('travel-consultant/dashboard', 'index')->name('travelconsultant.dashboard');
            Route::get('travel-consultant/pricing/{clientId}', 'pricing')->name('travelconsultant.pricing');
            Route::get('travel-consultant/profile-management/{clientId}', 'profileManagement')->name('travelconsultant.profile_management');
            Route::get('travel-consultant/vip/{clientId}', 'vip')->name('travelconsultant.vip');
            Route::get('travel-consultant/client-booker-approver/{clientId}', 'clientBookerApprover')->name('travelconsultant.client_booker_approver');
            Route::get('travel-consultant/booking-process/{clientId}', 'bookingProcess')->name('travelconsultant.booking_process');
            Route::get('travel-consultant/air/{clientId}', 'air')->name('travelconsultant.air');
            Route::get('travel-consultant/hotel/{clientId}', 'hotel')->name('travelconsultant.hotel');
            Route::get('travel-consultant/car/{clientId}', 'car')->name('travelconsultant.car');
            Route::get('travel-consultant/car-transfer/{clientId}', 'carTransfer')->name('travelconsultant.car_transfer');
            Route::get('travel-consultant/documentation/{clientId}', 'documentation')->name('travelconsultant.documentation');
            Route::get('travel-consultant/reporting-elements/{clientId}', 'reportingElements')->name('travelconsultant.reporting_elements');
            Route::get('travel-consultant/client/basic-info/{clientId}', 'basicInfo')->name('travelconsultant.basic_info');
            Route::get('travel-consultant/client/{clientId}', 'showClient')->name('travelconsultant.client.show');


        });
    });

    // Account Manager routes
    Route::middleware(['auth', 'checkUserRole:1'])->group(function () {
        Route::controller(AccountManagerController::class)->group(function () {
            // ... Your Account Manager routes ...
            Route::get('account-manager/dashboard', 'index')->name('accountmanager.dashboard');
            Route::get('account-manager/pricing', 'pricing')->name('accountmanager.pricing');
            Route::get('account-manager/assign', 'assignClient')->name('accountmanager.assign');
            Route::post('account-manager/update-user-clients', 'updateUserClients')->name('accountmanager.update.userclients');
            Route::get('account-manager/clients/vip/{clientId}', 'createVip')->name('accountmanager.clients.vip.create');
            Route::get('account-manager/clients/contact/{clientId}', 'createContact')->name('accountmanager.clients.contact.create');
            Route::get('account-manager/clients/booker/{clientId}', 'createBooker')->name('accountmanager.clients.booker.create');
            Route::get('account-manager/clients/pricingmodel/{clientId}', 'pricingModel')->name('accountmanager.clients.pricingmodel');
            Route::get('account-manager/clients/fare-reference/{clientId}', 'fareReference')->name('accountmanager.clients.fare_reference');
            Route::get('account-manager/clients/ancilliary_fees/{clientId}', 'ancilliaryFees')->name('accountmanager.clients.ancilliary_fees');
            Route::get('account-manager/clients/fees/{clientId}', 'tableOfFees')->name('accountmanager.clients.fees');
            Route::get('account-manager/clients/invoice-attachment/{clientId}', 'invoiceAttachment')->name('accountmanager.clients.invoice_attachment');
            Route::get('account-manager/clients/booking-process/{clientId}/{categoryId}', 'bookingProcess')->name('accountmanager.clients.booking_process');
            Route::get('account-manager/clients/travel-policy/{clientId}', 'travelPolicy')->name('accountmanager.clients.travel_policy');
            Route::get('account-manager/clients/preferred-airlines/{clientId}', 'preferredAirlines')->name('accountmanager.clients.preferred_airlines');
            Route::get('account-manager/clients/travel-security/{clientId}', 'travelSecurity')->name('accountmanager.clients.travel_security');
            Route::get('account-manager/clients/hote-corporate-code/{clientId}', 'hotelCorporateCode')->name('accountmanager.clients.hotel_corporate_code');
            Route::get('account-manager/clients/reporting-elements/{clientId}', 'reportingElements')->name('accountmanager.clients.reporting_elements');

            // Client creation routes
            Route::controller(ClientController::class)->group(function () {
                Route::get('account-manager/clients/create', 'create')->name('accountmanager.clients.create');
                Route::post('account-manager/clients/store', 'store')->name('accountmanager.clients.store');
                Route::get('account-manager/clients', 'index')->name('accountmanager.clients.index');
                Route::get('account-manager/clients/{clientId}', 'show')->name('accountmanager.clients.show');
                Route::get('account-manager/clients/{clientId}/edit', 'edit')->name('accountmanager.clients.edit');
                Route::put('account-manager/clients/{clientId}', 'update')->name('accountmanager.clients.update');
                Route::get('account-manager/clients/{clientId}/delete', 'confirmDelete')->name('accountmanager.clients.confirmDelete');
                Route::delete('account-manager/clients/{clientId}', 'destroy')->name('accountmanager.clients.destroy');
                Route::put('account-manager/clients/{clientId}/toggle', 'toggleStatus')->name('accountmanager.clients.toggleStatus');
            });

            // Client Info routes
            Route::controller(ClientInfoController::class)->group(function () {
                Route::put('account-manager/clients/info/update', 'update')->name('accountmanager.clients.info.update');
            });

            // Client VIP routes
            Route::controller(ClientVipController::class)->group(function () {
                Route::post('account-manager/clients/vip/store', 'store')->name('accountmanager.client.vip.create');
                Route::get('account-manager/clients/vip/{clientVipId}/edit', 'edit')->name('accountmanager.client.vip.edit');
                Route::post('account-manager/clients/vip/update', 'update')->name('accountmanager.client.vip.update');
                Route::delete('account-manager/clients/{clientId}/vips/{vipId}', 'destroy')->name('accountmanager.client.vip.destroy');
                Route::post('account-manager/clients/{clientId}/vips/{vipId}/update-status', 'updateStatus')->name('accountmanager.client.vip.update_status');
            });

            // Client Contact routes
            Route::controller(ClientContactController::class)->group(function () {
                Route::post('account-manager/clients/contact/store', 'store')->name('accountmanager.client.contact.create');
                Route::get('account-manager/clients/contact/{clientVipId}/edit', 'edit')->name('accountmanager.client.contact.edit');
                Route::put('account-manager/clients/contact/update', 'update')->name('accountmanager.client.contact.update');
                Route::delete('account-manager/clients/{clientId}/contacts/{contactId}', 'destroy')->name('accountmanager.client.contact.destroy');
                Route::post('account-manager/clients/{clientId}/contacts/{contactId}/update-status', 'updateStatus')->name('accountmanager.client.contact.update_status');
            });

            // Client Booker routes
            Route::controller(ClientBookerController::class)->group(function () {
                Route::post('account-manager/client/booker/store', 'saveSteps')->name('accountmanager.client.booker.create');
            });

            // Assign Client routes
            Route::controller(UserClientController::class)->group(function () {
                Route::get('account-manager/user-clients-data', 'getClientData')->name('accountmanager.client.data');
            });

            // Client Pricing Model routes
            Route::controller(PricingmodelController::class)->group(function () {
                Route::post('account-manager/client/pricingmodel/store', 'store')->name('accountmanager.client.pricingmodel.create');
            });

            // Client Fare Reference
            Route::controller(ClientFareReferenceController::class)->group(function () {
                Route::post('account-manager/client_fare_reference/store', 'store')->name('accountmanager.client.fare_reference.create');
                Route::delete('accountmanager/client/fare_reference/delete/{id}', 'destroy')->name('accountmanager.client.fare_reference.delete');
            });

            // Client Ancilliary Fee
            Route::controller(AncilliaryFeeController::class)->group(function () {
                Route::post('account-manager/client_ancilliary_fee/store', 'store')->name('accountmanager.client.ancilliary_fee.create');
            });

            // Client Table of Fees
            Route::controller(ClientFeeController::class)->group(function () {
                Route::post('account-manager/fees/store', 'store')->name('accountmanager.client.fee.create');
                Route::put('account-manager/fees/update', 'update')->name('accountmanager.client.fee.update');
                Route::delete('account-manager/fees/destroy', 'destroy')->name('accountmanager.client.fee.destroy');
            });

            // Client Invoice Attachment
            Route::controller(ClientInvoiceAttachmentController::class)->group(function () {
                Route::get('account-manager/client-invoice-attachments', 'index')->name('accountmanager.client.invoice_attachment.index');
                Route::get('account-manager/client-invoice-attachments/create', 'create')->name('accountmanager.client.invoice_attachment.create');
                Route::post('account-manager/client-invoice-attachments', 'store')->name('accountmanager.client.invoice_attachment.store');
                Route::get('account-manager/client-invoice-attachments/{clientInvoiceAttachment}', 'show')->name('accountmanager.client.invoice_attachments.show');
                Route::get('account-manager/client-invoice-attachments/{clientInvoiceAttachment}/edit', 'edit')->name('accountmanager.client.invoice_attachments.edit');
                Route::put('account-manager/client-invoice-attachments/{clientInvoiceAttachment}', 'update')->name('accountmanager.client.invoice_attachments.update');
                Route::delete('account-manager/client-invoice-attachments/{clientInvoiceAttachment}', 'destroy')->name('accountmanager.client.invoice_attachments.destroy');
                Route::put('account-manager/client-invoice-attachments/{clientInvoiceAttachment}/update-status', 'updateStatus')->name('accountmanager.client.invoice_attachments.update_status');
            });

            // Client International Booking Process
            Route::controller(ClientBookingProcessController::class)->group(function () {
                Route::post('account-manager/client-bookingprocess/store', 'store')->name('accountmanager.client.booking_process.create');
                Route::put('account-manager/client-bookingprocess/update', 'update')->name('accountmanager.client.booking_process.update');
                Route::delete('account-manager/client-bookingprocess/destroy', 'destroy')->name('accountmanager.client.booking_process.destroy');
            });

            // Client Travel Policy
            Route::controller(ClientTravelPolicyController::class)->group(function () {
                Route::post('account-manager/client/travel-policy/store', 'store')->name('accountmanager.client.travel_policy.create');
                Route::post('account-manager/client/travel-policy/update', 'update')->name('accountmanager.client.travel_policy.update');
            });

            // Client Preferred Airlines
            Route::controller(ClientPreferredAirlinesController::class)->group(function () {
                Route::post('account-manager/client/preferred-airlines/store', 'store')->name('accountmanager.client.preferred_airlines.create');
            });

            // Client Travel Security
            Route::controller(ClientTravelSecurityController::class)->group(function () {
                Route::post('account-manager/client/travel-security/store', 'store')->name('accountmanager.client.travel_security.create');
                Route::post('account-manager/client/travel-security/update', 'update')->name('accountmanager.client.travel_security.update');
            });

            // Client Preferred Airlines
            Route::controller(ClientHotelCorporateCodeController::class)->group(function () {
                Route::post('account-manager/client/hotel-corporate-code/store', 'store')->name('accountmanager.client.hotel_corporate_code.create');
                Route::put('account-manager/client/hotel-corporate-code/update', 'update')->name('accountmanager.client.hotel_corporate_code.update');
                Route::delete('account-manager/client/hotel-corporate-code/destroy', 'destroy')->name('accountmanager.client.hotel_corporate_code.destroy');
            });

            //Client Reporting Elements
            Route::controller(ClientReportingElementController::class)->group(function () {
                Route::post('account-manager/client/reporting-elements/store', 'store')->name('accountmanager.client.reporting_elements.create');
                Route::put('account-manager/client/reporting-elements/update', 'update')->name('accountmanager.client.reporting_elements.update');
                Route::delete('account-manager/client/reporting-elements/destroy', 'destroy')->name('accountmanager.client.reporting_elements.destroy');
            });
        });
    });

    // Administrator routes
    Route::middleware(['auth', 'checkUserRole:3'])->group(function () {
        Route::controller(AdministratorController::class)->group(function () {
            // ... Your Administrator routes ...
            Route::get('administrator/dashboard', 'index')->name('administrator.dashboard');
            Route::get('administrator/user-activities', 'showUserActivities')->name('administrator.user-activities');
            Route::get('administrator/users/create', 'createUser')->name('administrator.create.user');
            Route::get('administrator/assign-clients', 'assignClients')->name('administrator.assign.clients');
            Route::get('administrator/assign-clients-account-manager', 'assignClientsToAccountManager')->name('administrator.assign.clients.accountmanager');
            Route::get('administrator/clients', 'showClients')->name('administrator.clients');
            Route::get('administrator/clients/create', 'createClient')->name('administrator.create.client');
            Route::get('administrator/clients/categories', 'addCategories')->name('administrator.categories');
            Route::get('administrator/clients/routes', 'addRoutes')->name('administrator.routes');
            Route::get('administrator/clients/sources', 'addSources')->name('administrator.sources');
            Route::get('administrator/airlines', 'addAirlines')->name('administrator.airlines');
        });

        // User creation routes
        Route::controller(UserController::class)->group(function () {
            Route::post('user/store', 'register')->name('user.register');
        });

        // Clients
        Route::controller(ClientController::class)->group(function () {
            Route::get('administrator/get-unassigned-clients/{accountManagerId}', 'getUnassignedClients')->name('administrator.get_unassigned_clients');
            Route::post('administrator/clients/store', 'store')->name('administrator.clients.store');
            Route::put('administrator/clients/update-account-manager', 'updateAccountManager')->name('administrator.clients.update.accountmanager');
        });

        // Assign clients
        Route::controller(UserClientController::class)->group(function () {
            Route::post('administrator/user-client/store', 'store')->name('administrator.user_client.create');
        });

        // Category
        Route::controller(CategoryController::class)->group(function () {
            Route::post('administrator/category/store', 'store')->name('administrator.category.create');
            Route::delete('administrator/category/destroy', 'destroy')->name('administrator.category.destroy');
        });

        // Route
        Route::controller(RouteController::class)->group(function () {
            Route::post('administrator/route/store', 'store')->name('administrator.route.create');
            Route::delete('administrator/route/destroy', 'destroy')->name('administrator.route.destroy');
        });

        // Source
        Route::controller(SourceController::class)->group(function () {
            Route::post('administrator/source/store', 'store')->name('administrator.source.create');
            Route::delete('administrator/source/destroy', 'destroy')->name('administrator.source.destroy');
        });

        // Airline
        Route::controller(AirlineController::class)->group(function () {
            Route::post('administrator/airline/store', 'store')->name('administrator.airline.create');
            Route::put('administrator/airline/update', 'update')->name('administrator.airline.update');
            Route::delete('administrator/airline/destroy', 'destroy')->name('administrator.airline.destroy');
        });
    });

});
