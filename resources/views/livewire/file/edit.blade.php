<div class="d-flex flex-column flex-column-fluid">

    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">

            {{-- <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Edit
                    Product</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">eCommerce</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Catalog</li>
                </ul>
            </div>

            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                <div class="m-0">
                    <!--begin::Menu toggle-->
                    <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>Filter</a>
                    <!--end::Menu toggle-->
                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                        id="kt_menu_6678170506ce8">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                            <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Menu separator-->
                        <div class="separator border-gray-200"></div>
                        <!--end::Menu separator-->
                        <!--begin::Form-->
                        <div class="px-7 py-5">
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Status:</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div>
                                    <select class="form-select form-select-solid" multiple="multiple"
                                        data-kt-select2="true" data-close-on-select="false"
                                        data-placeholder="Select option" data-dropdown-parent="#kt_menu_6678170506ce8"
                                        data-allow-clear="true">
                                        <option></option>
                                        <option value="1">Approved</option>
                                        <option value="2">Pending</option>
                                        <option value="2">In Process</option>
                                        <option value="2">Rejected</option>
                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Member Type:</label>
                                <!--end::Label-->
                                <!--begin::Options-->
                                <div class="d-flex">
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                        <span class="form-check-label">Author</span>
                                    </label>
                                    <!--end::Options-->
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="2"
                                            checked="checked" />
                                        <span class="form-check-label">Customer</span>
                                    </label>
                                    <!--end::Options-->
                                </div>
                                <!--end::Options-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Notifications:</label>
                                <!--end::Label-->
                                <!--begin::Switch-->
                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" name="notifications"
                                        checked="checked" />
                                    <label class="form-check-label">Enabled</label>
                                </div>
                                <!--end::Switch-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                    data-kt-menu-dismiss="true">Reset</button>
                                <button type="submit" class="btn btn-sm btn-primary"
                                    data-kt-menu-dismiss="true">Apply</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Menu 1-->
                </div>
                <!--end::Filter menu-->
                <!--begin::Secondary button-->
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_create_app">Create</a>
                <!--end::Primary button-->
            </div> --}}
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <form class="form d-flex flex-column flex-lg-row">
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                {{-- <h2>Thumbnail</h2> --}}
                            </div>
                        </div>
                        <div class="card-body text-center pt-0">
                            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                data-kt-image-input="true">
                                <div class="image-input-wrapper w-150px h-150px" {{-- style="background-image: url(assets/media//stock/ecommerce/78.png)" --}}></div>
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="text-muted fs-7">{{ $file->name }}</div>
                        </div>
                    </div>

                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Status</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <div class="rounded-circle bg-success w-15px h-15px"
                                    id="kt_ecommerce_add_product_status"></div>
                            </div>
                            <!--begin::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Select2-->
                            <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select">
                                <option></option>
                                <option value="published" selected="selected">Published</option>
                                <option value="draft">Draft</option>
                                <option value="scheduled">Scheduled</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <!--end::Select2-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Set the product status.</div>
                            <!--end::Description-->
                            <!--begin::Datepicker-->
                            <div class="d-none mt-10">
                                <label for="kt_ecommerce_add_product_status_datepicker" class="form-label">Select
                                    publishing date and time</label>
                                <input class="form-control" id="kt_ecommerce_add_product_status_datepicker"
                                    placeholder="Pick date & time" />
                            </div>
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Card body-->
                    </div>

                    {{-- <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Product Details</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <label class="form-label">Categories</label>
                            <select class="form-select mb-2" data-control="select2" data-placeholder="Select an option"
                                data-allow-clear="true" multiple="multiple">
                                <option></option>
                                <option value="Computers">Computers</option>
                                <option value="Watches">Watches</option>
                                <option value="Headphones">Headphones</option>
                                <option value="Footwear">Footwear</option>
                                <option value="Cameras">Cameras</option>
                                <option value="Shirts">Shirts</option>
                                <option value="Household">Household</option>
                                <option value="Handbags">Handbags</option>
                                <option value="Wines">Wines</option>
                                <option value="Sandals">Sandals</option>
                            </select>
                            <div class="text-muted fs-7 mb-7">Add product to a category.</div>
                            <a href="apps/ecommerce/catalog/add-category.html"
                                class="btn btn-light-primary btn-sm mb-10">
                                <i class="ki-duotone ki-plus fs-2"></i>Create new category</a>
                            <label class="form-label d-block">Tags</label>
                            <input id="kt_ecommerce_add_product_tags" name="kt_ecommerce_add_product_tags"
                                class="form-control mb-2" value="new, trending, sale" />
                            <div class="text-muted fs-7">Add tags to a product.</div>
                        </div>
                    </div> --}}

                    {{-- <div class="card card-flush">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">$</span>
                                    <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">2,420</span>
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>2.6%</span>
                                </div>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Average Daily Sales</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end px-0 pb-0">
                            <div id="kt_card_widget_6_chart" class="w-100" style="height: 80px"></div>
                        </div>
                    </div> --}}

                    {{-- <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Product Template</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <label for="kt_ecommerce_add_product_store_template" class="form-label">Select a product
                                template</label>
                            <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                data-placeholder="Select an option" id="kt_ecommerce_add_product_store_template">
                                <option></option>
                                <option value="default" selected="selected">Default template</option>
                                <option value="electronics">Electronics</option>
                                <option value="office">Office stationary</option>
                                <option value="fashion">Fashion</option>
                            </select>
                            <div class="text-muted fs-7">Assign a template from your current theme to define how a
                                single product is displayed.</div>
                        </div>
                    </div> --}}

                </div>
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ $file->name }}</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Name</label>
                                    <input type="text" wire:model="name" class="form-control mb-2" />
                                    {{-- <div class="text-muted fs-7">Enter the product SKU.</div> --}}
                                </div>
                                <div class="mb-10 fv-row">
                                    <label class="form-label">Verified by</label>
                                    <input type="text" wire:model="verified_by" class="form-control mb-2"
                                        placeholder="Type or click here" />
                                    {{-- <div class="text-muted fs-7">Enter the product SKU.</div> --}}
                                </div>
                                {{-- <div class="mb-10 fv-row">
                                    <label class="required form-label">Date</label>
                                    <input type="date" name="barcode" class="form-control mb-2"/>
                                    <div class="text-muted fs-7">Enter the product barcode number.</div>
                                </div> --}}

                                <div class="mb-10 row">
                                    <div class="col-6">

                                        <label class="form-label">Date</label>
                                        <input type="date" wire:model="date" class="form-control mb-2" />
                                    </div>

                                    <div class="col-6">

                                        <label class="form-label">Due Date</label>
                                        <input type="date" wire:model="due_date" class="form-control mb-2" />
                                    </div>
                                </div>

                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Note</label>
                                    <textarea wire:model="description" class="form-control mb-2" rows="5"></textarea>
                                    {{-- <div class="d-flex gap-3">
                                        <input type="number" name="shelf" class="form-control mb-2"
                                            placeholder="On shelf" value="24" />
                                        <input type="number" name="warehouse" class="form-control mb-2"
                                            placeholder="In warehouse" />
                                    </div>
                                    <div class="text-muted fs-7">Enter the product quantity.</div> --}}
                                </div>
                                {{-- <div class="fv-row">
                                    <label class="form-label">Allow Backorders</label>
                                    <div class="form-check form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input" type="checkbox" value="" />
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="text-muted fs-7">Allow customers to purchase products that are
                                        out of stock.</div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Custom Metadata Fields</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                    <label class="form-label">Manage all metadata fields</label>
                                    <div id="kt_ecommerce_add_product_options">
                                        <div class="form-group">

                                            @foreach ($file->metadatas as $metadata)
                                                <div class="d-flex flex-column gap-3">
                                                    <div data-repeater-item=""
                                                        class="form-group d-flex flex-wrap align-items-center gap-5">
                                                        <div class="w-100 w-md-200px">
                                                            <input type="text" class="form-control mw-100 w-200px"
                                                                id="{{ $metadata->name }}_{{ $metadata->id }}"
                                                                value="{{ $metadata->name }}" readonly />
                                                        </div>
                                                        <input type="text" readonly class="form-control mw-100 w-200px"
                                                            value="{{ $metadata->value }}" />
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-light-secondary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_metadata_value"
                                                            {{-- onclick="setMetadataId('{{ $metadata->id }}','{{ $metadata->name }}')" --}}
                                                            wire:click="setSelectedMetadata({{ $metadata->id }},'{{ $metadata->name }}')">
                                                            <i class="fas fa-edit fs-1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                        </button>

                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-light-danger">
                                                            <i class="ki-duotone ki-cross fs-1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                        </button>
                                                    </div>
                                                </div>

                                                {{-- <div class="row mb-5">
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control"
                                                            value="{{ $metadata->string_value }}" disabled>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a type="button"
                                                            class="btn btn-icon btn-primary mr-3 passingID"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_metadata_value"
                                                            onclick="setMetadataId('{{ $metadata->id }}','{{ $metadata->name }}')"><i
                                                                class="fas fa-plus"></i>
                                                        </a>
                                                        <a href="{{ route('documents.edit', 1) }}"
                                                            class="btn btn-icon btn-danger mr-2"><i
                                                                class="fas fa-trash"></i></a>
                                                    </div>
                                                </div> --}}
                                            @endforeach

                                            {{-- <div data-repeater-list="kt_ecommerce_add_product_options"
                                                class="d-flex flex-column gap-3">
                                                <div data-repeater-item=""
                                                    class="form-group d-flex flex-wrap align-items-center gap-5">
                                                    <div class="w-100 w-md-200px">
                                                        <select class="form-select" name="product_option"
                                                            data-placeholder="Select a variation"
                                                            data-kt-ecommerce-catalog-add-product="product_option">
                                                            <option></option>
                                                            <option value="color">Color</option>
                                                            <option value="size">Size</option>
                                                            <option value="material">Material</option>
                                                            <option value="style">Style</option>
                                                        </select>
                                                    </div>
                                                    <input type="text" class="form-control mw-100 w-200px"
                                                        name="product_option_value" placeholder="Variation" />
                                                    <button type="button" data-repeater-delete=""
                                                        class="btn btn-sm btn-icon btn-light-danger">
                                                        <i class="ki-duotone ki-cross fs-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </button>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="form-group mt-5">
                                            <button type="button" class="btn btn-sm btn-light-primary"
                                                data-bs-toggle="modal" id="sendMailButton"
                                                data-bs-target="#kt_modal_metadata">
                                                <i class="ki-duotone ki-plus fs-2"></i>Add new metadata</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Shipping</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="fv-row">
                                    <div class="form-check form-check-custom form-check-solid mb-2">
                                        <input class="form-check-input" type="checkbox"
                                            id="kt_ecommerce_add_product_shipping_checkbox" value="1"
                                            checked="checked" />
                                        <label class="form-check-label">This is a physical product</label>
                                    </div>
                                    <div class="text-muted fs-7">Set if the product is a physical or digital
                                        item. Physical products may require shipping.</div>
                                </div>
                                <div id="kt_ecommerce_add_product_shipping" class="mt-10">
                                    <div class="mb-10 fv-row">
                                        <label class="form-label">Weight</label>
                                        <input type="text" name="weight" class="form-control mb-2"
                                            placeholder="Product weight" value="4.3" />
                                        <div class="text-muted fs-7">Set a product weight in kilograms (kg).
                                        </div>
                                    </div>
                                    <div class="fv-row">
                                        <label class="form-label">Dimension</label>
                                        <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                                            <input type="number" name="width" class="form-control mb-2"
                                                placeholder="Width (w)" value="12" />
                                            <input type="number" name="height" class="form-control mb-2"
                                                placeholder="Height (h)" value="4" />
                                            <input type="number" name="length" class="form-control mb-2"
                                                placeholder="Lengtn (l)" value="8.5" />
                                        </div>
                                        <div class="text-muted fs-7">Enter the product dimensions in
                                            centimeters (cm).</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Meta Options</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Meta Tag Title</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="meta_title"
                                        placeholder="Meta tag name" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple
                                        and precise keywords.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Meta Tag Description</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <div id="kt_ecommerce_add_product_meta_description"
                                        name="kt_ecommerce_add_product_meta_description" class="min-h-100px mb-2">
                                    </div>
                                    <!--end::Editor-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a meta tag description to the product for
                                        increased SEO ranking.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div>
                                    <!--begin::Label-->
                                    <label class="form-label">Meta Tag Keywords</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <input id="kt_ecommerce_add_product_meta_keywords"
                                        name="kt_ecommerce_add_product_meta_keywords" class="form-control mb-2" />
                                    <!--end::Editor-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a list of keywords that the product is
                                        related to. Separate the keywords by adding a comma
                                        <code>,</code>between each keyword.
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div> --}}
                    </div>
                    <div class="d-flex justify-content-end">
                        <a onclick="history.back()" class="btn btn-light me-5">Cancel</a>
                        <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                            <span class="indicator-label">Save Changes</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="kt_modal_metadata" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_metadata_header">
                    <h2>New metadata field for "{{ $file->name }}"</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>

                <div class="modal-body py-10 px-lg-17">

                    <div class="scroll-y me-n7 pe-7" id="kt_modal_metadata_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_metadata_header"
                        data-kt-scroll-wrappers="#kt_modal_metadata_scroll" data-kt-scroll-offset="300px">
                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Field Name</label>
                            <input type="text" class="form-control" wire:model.live="metadata_name" required>
                        </div>

                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Field Description</label>
                            <textarea class="form-control" rows="3" wire:model.live="metadata_description"></textarea>
                        </div>

                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Data Type</label>
                            <select wire:model.live="metadata_data_type" aria-label="Select a data type"
                                data-control="select" data-placeholder="Select a data type..."
                                class="form-select mb-2" required>
                                <option></option>
                                <option value="string">String</option>
                                <option value="date">Date</option>
                                <option value="datetime">Date Time</option>
                                <option value="boolean">Boolean</option>
                                <option value="float">Float</option>
                                <option value="integer">Integer</option>
                                <option value="longtext">Long Text</option>
                            </select>
                        </div>

                        <div class="d-flex">
                            <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                <input class="form-check-input h-30px w-50px"
                                    wire:model.live="metadata_allow_multiple_use" type="checkbox" value="1"
                                    {{-- checked="checked" --}} />
                                <label class="form-check-label" for="public_read">Allow using multiple times for the
                                    same
                                    file</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button wire:click="store_metadata" class="btn btn-primary">
                        <span class="indicator-label">Save</span>
                    </button>
                </div>
                {{-- {!! Form::close() !!} --}}

            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="kt_modal_metadata_value" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_metadata_value_header">
                    <h2>Add metadata value</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>

                <div class="modal-body py-10 px-lg-17">

                    <div class="scroll-y me-n7 pe-7" id="kt_modal_metadata_value_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_metadata_value_header"
                        data-kt-scroll-wrappers="#kt_modal_metadata_value_scroll" data-kt-scroll-offset="300px">
                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Field Name</label>
                            <input type="text" class="form-control" wire:model.live="selected_metadata_name" disabled>
                        </div>

                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="fs-5 fw-semibold mb-2">Value</label>
                            <input type="text" class="form-control" wire:model.live="selected_metadata_value">
                        </div>

                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button wire:click="store_metadata_value" class="btn btn-primary">
                        <span class="indicator-label">Save</span>
                    </button>
                </div>

            </div>
        </div>
    </div>

</div>


<script>
    function setMetadataId(id, name) {
        // alert(id);
        document.getElementById('modal_metadata_id').value = id;
        document.getElementById('modal_metadata_name').value = name;
    }

    document.getElementById("sendMailButton").addEventListener("click", sendMailClicked);

    function sendMailClicked() {
        var theValue = document.getElementById('inputid').value;
        var modalContainer = document.getElementById('emailModal')
        var myModal = new bootstrap.Modal(modalContainer, {
            backdrop: 'static'
        })

        modalContainer.querySelector(".modal-body").innerHTML = "Your value is: " + theValue;

        myModal.show();
    }
</script>
