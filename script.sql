create table clients
(
    id              bigint unsigned auto_increment
        primary key,
    document_type   char                   default 'V'  not null,
    document_id     int                                 not null,
    name            varchar(255)                        not null,
    email           varchar(255)                        null,
    phone           varchar(255)                        null,
    last_purchase   timestamp                           null,
    total_purchases int unsigned           default 0    not null,
    total_paid      decimal(8, 2) unsigned default 0.00 not null,
    created_at      timestamp                           null,
    updated_at      timestamp                           null,
    deleted_at      timestamp                           null,
    balance         decimal(8, 2)          default 0.00 not null,
    constraint clients_document_id_unique
        unique (document_id)
)
    collate = utf8mb4_unicode_ci;

create table failed_jobs
(
    id         bigint unsigned auto_increment
        primary key,
    uuid       varchar(255)                          not null,
    connection text                                  not null,
    queue      text                                  not null,
    payload    longtext                              not null,
    exception  longtext                              not null,
    failed_at  timestamp default current_timestamp() not null,
    constraint failed_jobs_uuid_unique
        unique (uuid)
)
    collate = utf8mb4_unicode_ci;

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

create table password_resets
(
    email      varchar(255) not null,
    token      varchar(255) not null,
    created_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create index password_resets_email_index
    on password_resets (email);

create table payment_methods
(
    id          bigint unsigned auto_increment
        primary key,
    name        varchar(255) not null,
    description text         null,
    created_at  timestamp    null,
    updated_at  timestamp    null,
    deleted_at  timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table personal_access_tokens
(
    id             bigint unsigned auto_increment
        primary key,
    tokenable_type varchar(255)    not null,
    tokenable_id   bigint unsigned not null,
    name           varchar(255)    not null,
    token          varchar(64)     not null,
    abilities      text            null,
    last_used_at   timestamp       null,
    expires_at     timestamp       null,
    created_at     timestamp       null,
    updated_at     timestamp       null,
    constraint personal_access_tokens_token_unique
        unique (token)
)
    collate = utf8mb4_unicode_ci;

create index personal_access_tokens_tokenable_type_tokenable_id_index
    on personal_access_tokens (tokenable_type, tokenable_id);

create table product_categories
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255)         not null,
    status     tinyint(1) default 0 not null,
    created_at timestamp            null,
    updated_at timestamp            null,
    deleted_at timestamp            null
)
    collate = utf8mb4_unicode_ci;

create table products
(
    id                  bigint unsigned auto_increment
        primary key,
    name                varchar(255)            not null,
    description         text                    null,
    product_category_id bigint unsigned         not null,
    price               decimal(10, 2) unsigned not null,
    stock               int unsigned default 0  not null,
    stock_defective     int unsigned default 0  not null,
    status              tinyint(1)   default 0  not null,
    created_at          timestamp               null,
    updated_at          timestamp               null,
    deleted_at          timestamp               null,
    constraint products_product_category_id_foreign
        foreign key (product_category_id) references product_categories (id)
)
    collate = utf8mb4_unicode_ci;

create table assets
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255)    not null,
    product_id bigint unsigned not null,
    created_at timestamp       null,
    updated_at timestamp       null,
    constraint assets_product_id_foreign
        foreign key (product_id) references products (id)
)
    collate = utf8mb4_unicode_ci;

create table providers
(
    id          bigint unsigned auto_increment
        primary key,
    name        varchar(255) not null,
    description text         null,
    paymentinfo text         null,
    email       varchar(255) null,
    phone       varchar(255) null,
    created_at  timestamp    null,
    updated_at  timestamp    null,
    deleted_at  timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table transfers
(
    id                 bigint unsigned auto_increment
        primary key,
    title              varchar(255)    null,
    sender_method_id   bigint unsigned not null,
    receiver_method_id bigint unsigned not null,
    sended_amount      decimal(10, 2)  not null,
    received_amount    decimal(10, 2)  not null,
    reference          varchar(255)    null,
    created_at         timestamp       null,
    updated_at         timestamp       null,
    constraint transfers_receiver_method_id_foreign
        foreign key (receiver_method_id) references payment_methods (id),
    constraint transfers_sender_method_id_foreign
        foreign key (sender_method_id) references payment_methods (id)
)
    collate = utf8mb4_unicode_ci;

create table users
(
    id                bigint unsigned auto_increment
        primary key,
    name              varchar(255) not null,
    email             varchar(255) not null,
    email_verified_at timestamp    null,
    password          varchar(255) not null,
    remember_token    varchar(100) null,
    created_at        timestamp    null,
    updated_at        timestamp    null,
    deleted_at        timestamp    null,
    constraint users_email_unique
        unique (email)
)
    collate = utf8mb4_unicode_ci;

create table receipts
(
    id           bigint unsigned auto_increment
        primary key,
    title        varchar(255)    not null,
    provider_id  bigint unsigned null,
    user_id      bigint unsigned not null,
    finalized_at timestamp       null,
    created_at   timestamp       null,
    updated_at   timestamp       null,
    constraint receipts_provider_id_foreign
        foreign key (provider_id) references providers (id),
    constraint receipts_user_id_foreign
        foreign key (user_id) references users (id)
)
    collate = utf8mb4_unicode_ci;

create table received_products
(
    id              bigint unsigned auto_increment
        primary key,
    receipt_id      bigint unsigned not null,
    product_id      bigint unsigned not null,
    stock           int             not null,
    stock_defective int             not null,
    created_at      timestamp       null,
    updated_at      timestamp       null,
    constraint received_products_product_id_foreign
        foreign key (product_id) references products (id),
    constraint received_products_receipt_id_foreign
        foreign key (receipt_id) references receipts (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;

create table sales
(
    id           bigint unsigned auto_increment
        primary key,
    user_id      bigint unsigned not null,
    client_id    bigint unsigned not null,
    total_amount decimal(10, 2)  null,
    finalized_at timestamp       null,
    created_at   timestamp       null,
    updated_at   timestamp       null,
    constraint sales_client_id_foreign
        foreign key (client_id) references clients (id),
    constraint sales_user_id_foreign
        foreign key (user_id) references users (id)
)
    collate = utf8mb4_unicode_ci;

create table sold_products
(
    id           bigint unsigned auto_increment
        primary key,
    sale_id      bigint unsigned not null,
    product_id   bigint unsigned not null,
    qty          int             not null,
    price        decimal(10, 2)  not null,
    total_amount decimal(10, 2)  not null,
    created_at   timestamp       null,
    updated_at   timestamp       null,
    constraint sold_products_product_id_foreign
        foreign key (product_id) references products (id),
    constraint sold_products_sale_id_foreign
        foreign key (sale_id) references sales (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;

create table transactions
(
    id                bigint unsigned auto_increment
        primary key,
    type              varchar(255)    not null,
    title             varchar(255)    not null,
    reference         varchar(255)    null,
    client_id         bigint unsigned null,
    sale_id           bigint unsigned null,
    provider_id       bigint unsigned null,
    transfer_id       bigint unsigned null,
    payment_method_id bigint unsigned not null,
    amount            decimal(10, 2)  not null,
    user_id           bigint unsigned not null,
    created_at        timestamp       null,
    updated_at        timestamp       null,
    constraint transactions_client_id_foreign
        foreign key (client_id) references clients (id),
    constraint transactions_payment_method_id_foreign
        foreign key (payment_method_id) references payment_methods (id),
    constraint transactions_provider_id_foreign
        foreign key (provider_id) references providers (id),
    constraint transactions_sale_id_foreign
        foreign key (sale_id) references sales (id)
            on delete cascade,
    constraint transactions_transfer_id_foreign
        foreign key (transfer_id) references transfers (id)
            on delete cascade,
    constraint transactions_user_id_foreign
        foreign key (user_id) references users (id)
)
    collate = utf8mb4_unicode_ci;


