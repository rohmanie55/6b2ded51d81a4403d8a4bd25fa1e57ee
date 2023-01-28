CREATE TABLE mail_logs (
    id SERIAL PRIMARY KEY,
    subject character varying,
    send_to character varying,
    body text,
    status boolean,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at timestamp without time zone
);