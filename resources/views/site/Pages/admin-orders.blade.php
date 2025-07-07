@extends('site.master.page')

@section('js')
    <script src="{{ asset(mix('/assets/site/js/pages/adminOrders.js')) }}"></script>
@endsection

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
            {{-- Falta implementar paginação --}}
            <div class="admin-orders__pagination">
                <button id="prevPage" class="admin-orders__pagination-button button button--secondary"
                    disabled>Anterior</button>
                <span id="pageInfo" class="admin-orders__pagination-info">Página 1 de 1</span>
                <button id="nextPage" class="admin-orders__pagination-button button button--secondary"
                    disabled>Próxima</button>
            </div>
        </div>
    </section>
@endsection
