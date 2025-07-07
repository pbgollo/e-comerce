@extends('site.master.page')

@section('css')
@endsection

@section('content')
    <section class="admin-orders">
        <div class="admin-orders__header">
            <h1 class="admin-orders__title">Consulta e Gestão de Pedidos</h1>
        </div>

        <div class="admin-orders__search">
            <input type="text" id="orderSearchInput" class="admin-orders__search-input"
                placeholder="Buscar por nº do pedido ou nome do cliente">
            <button id="searchButton" class="admin-orders__search-button button button--primary">Buscar</button>
        </div>

        <div class="admin-orders__list-container">
            <div class="admin-orders__list-header">
                <p class="admin-orders__list-header-item">Nº Pedido</p>
                <p class="admin-orders__list-header-item">Cliente</p>
                <p class="admin-orders__list-header-item">Data</p>
                <p class="admin-orders__list-header-item">Valor Total</p>
                <p class="admin-orders__list-header-item">Status</p>
            </div>
            <div id="ordersList" class="admin-orders__list-body">
                <p class="admin-orders__list-empty-message">Nenhum pedido encontrado. Tente uma busca.</p>
            </div>
            <div class="admin-orders__pagination">
                <button id="prevPage" class="admin-orders__pagination-button button button--secondary"
                    disabled>Anterior</button>
                <span id="pageInfo" class="admin-orders__pagination-info">Página 1 de 1</span>
                <button id="nextPage" class="admin-orders__pagination-button button button--secondary"
                    disabled>Próxima</button>
            </div>
        </div>
    </section>

    <template id="orderRowTemplate">
        <div class="admin-orders__list-row admin-orders__list-row--expanded">
            <div class="admin-orders__list-summary">
                <p class="admin-orders__list-item" data-order-id></p>
                <p class="admin-orders__list-item" data-client-name></p>
                <p class="admin-orders__list-item" data-order-date></p>
                <p class="admin-orders__list-item" data-total-value></p>
                <p class="admin-orders__list-item status" data-order-status></p>
            </div>
            <div class="admin-orders__details-inline">
            </div>
        </div>
    </template>

    <template id="orderDetailsTemplate">
        <h3 class="admin-orders__items-title">Itens do Pedido</h3>
        <div class="admin-orders__items-list" data-items-list>
        </div>

        <h3 class="admin-orders__carousel-title">Fotos dos Produtos no Pedido</h3>
        <div class="admin-orders__carousel products_pics-embla">
            <div class="admin-orders__carousel-drag products_pics-embla__drag" data-product-images-carousel>
            </div>
            <button class="admin-orders__carousel-prev products_pics-embla-prev">
                <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="https://www.w3.org/2000/svg"
                    class="IconArrowCarousel">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M24 12.8182L21.8182 15L12 5.18182L2.18182 15L2.60179e-08 12.8182L12 0.818182L24 12.8182Z"
                        fill="#565C69"></path>
                </svg>
            </button>
            <button class="admin-orders__carousel-next products_pics-embla-next">
                <svg width="24" height="15" viewBox="0 0 24 15" fill="none" xmlns="https://www.w3.org/2000/svg"
                    class="IconArrowCarousel">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M24 12.8182L21.8182 15L12 5.18182L2.18182 15L2.60179e-08 12.8182L12 0.818182L24 12.8182Z"
                        fill="#565C69"></path>
                </svg>
            </button>
        </div>

        <div class="admin-orders__status-update">
            <h3 class="admin-orders__status-update-title">Atualizar Status do Pedido</h3>
            <div class="form-group admin-orders__form-group">
                <label class="admin-orders__form-label">Novo Status:</label>
                <select class="admin-orders__form-select" data-new-status-select onchange="handleStatusChange(this)">
                    <option value="novo">Novo</option>
                    <option value="enviado">Enviado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>
            <div class="form-group admin-orders__form-group" data-shipping-date-group style="display:none;">
                <label class="admin-orders__form-label">Data de Envio:</label>
                <input type="date" class="admin-orders__form-input" data-shipping-date-input>
            </div>
            <div class="form-group admin-orders__form-group" data-cancellation-date-group style="display:none;">
                <label class="admin-orders__form-label">Data de Cancelamento:</label>
                <input type="date" class="admin-orders__form-input" data-cancellation-date-input>
            </div>
            <button class="admin-orders__status-update-button button button--primary" data-update-status-button
                onclick="updateStatus(this)">Atualizar Status</button>
        </div>
    </template>

    <template id="orderItemTemplate">
        <div class="admin-orders__item">
            <p><strong>Produto:</strong> <span data-product-name></span></p>
            <p><strong>Quantidade:</strong> <span data-item-quantity></span></p>
            <p><strong>Valor Unitário:</strong> <span data-item-unit-price></span></p>
            <p><strong>Valor Total:</strong> <span data-item-total-price></span></p>
        </div>
    </template>

    <template id="productImageTemplate">
        <div class="products_pics-embla__slide">
            <img data-product-image src="" alt="">
        </div>
    </template>
@endsection

@section('js')
    <script src="{{ asset(mix('/assets/site/js/pages/adminOrders.js')) }}"></script>
@endsection
