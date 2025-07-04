@extends('site.master.page')

{{-- @section('js')
    <script src="{{ asset(mix('/assets/admin/js/admin-orders.js')) }}"></script>
@endsection --}}

@section('css')
@endsection

@section('content')
    <section class="admin-orders">
        <div class="admin-orders__header">
            <h1 class="admin-orders__title">Consulta e Gestão de Pedidos</h1>
        </div>

        <div class="admin-orders__search">
            <input type="text" id="orderSearchInput" class="admin-orders__search-input"
                placeholder="Buscar por Nº do Pedido ou Nome do Cliente">
            <button id="searchButton" class="admin-orders__search-button button button--primary">Buscar</button>
        </div>

        <div class="admin-orders__list-container">
            <div class="admin-orders__list-header">
                <p class="admin-orders__list-header-item">Nº Pedido</p>
                <p class="admin-orders__list-header-item">Cliente</p>
                <p class="admin-orders__list-header-item">Data</p>
                <p class="admin-orders__list-header-item">Valor Total</p>
                <p class="admin-orders__list-header-item">Status</p>
                <p class="admin-orders__list-header-item">Ações</p>
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

        <div id="orderDetails" class="admin-orders__details admin-orders__details--hidden">
            <button id="closeDetails" class="admin-orders__details-close button button--secondary">Fechar Detalhes</button>
            <h2 class="admin-orders__details-title">Detalhes do Pedido <span id="detailOrderNumber"></span></h2>
            <div class="admin-orders__details-master-info">
                <p class="admin-orders__details-info-item"><strong>Cliente:</strong> <span id="detailClientName"></span></p>
                <p class="admin-orders__details-info-item"><strong>Data:</strong> <span id="detailOrderDate"></span></p>
                <p class="admin-orders__details-info-item"><strong>Valor Total:</strong> <span id="detailTotalValue"></span>
                </p>
                <p class="admin-orders__details-info-item"><strong>Status Atual:</strong> <span
                        id="detailOrderStatus"></span></p>
            </div>

            <div class="admin-orders__status-update">
                <h3 class="admin-orders__status-update-title">Atualizar Status do Pedido</h3>
                <div class="form-group admin-orders__form-group">
                    <label for="newStatus" class="admin-orders__form-label">Novo Status:</label>
                    <select id="newStatus" class="admin-orders__form-select">
                        <option value="pending">Pendente</option>
                        <option value="processing">Em Processamento</option>
                        <option value="shipped">Enviado</option>
                        <option value="delivered">Entregue</option>
                        <option value="canceled">Cancelado</option>
                    </select>
                </div>
                <div class="form-group admin-orders__form-group" id="shippingDateGroup">
                    <label for="shippingDate" class="admin-orders__form-label">Data de Envio:</label>
                    <input type="date" id="shippingDate" class="admin-orders__form-input">
                </div>
                <div class="form-group admin-orders__form-group" id="cancellationDateGroup">
                    <label for="cancellationDate" class="admin-orders__form-label">Data de Cancelamento:</label>
                    <input type="date" id="cancellationDate" class="admin-orders__form-input">
                </div>
                <button id="updateStatusButton" class="admin-orders__status-update-button button button--primary">Atualizar
                    Status</button>
            </div>

            <h3 class="admin-orders__items-title">Itens do Pedido</h3>
            <div id="orderItemsList" class="admin-orders__items-list">
            </div>

            <h3 class="admin-orders__carousel-title">Fotos dos Produtos no Pedido</h3>
            <div class="admin-orders__carousel products_pics-embla">
                <div class="admin-orders__carousel-drag products_pics-embla__drag" id="productImageCarousel">
                </div>
                <button class="admin-orders__carousel-prev products_pics-embla-prev">
                    <svg width="24" height="15" viewBox="0 0 24 15" fill="none"
                        xmlns="https://www.w3.org/2000/svg" class="IconArrowCarousel">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M24 12.8182L21.8182 15L12 5.18182L2.18182 15L2.60179e-08 12.8182L12 0.818182L24 12.8182Z"
                            fill="#565C69"></path>
                    </svg>
                </button>
                <button class="admin-orders__carousel-next products_pics-embla-next">
                    <svg width="24" height="15" viewBox="0 0 24 15" fill="none"
                        xmlns="https://www.w3.org/2000/svg" class="IconArrowCarousel">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M24 12.8182L21.8182 15L12 5.18182L2.18182 15L2.60179e-08 12.8182L12 0.818182L24 12.8182Z"
                            fill="#565C69"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>
@endsection
