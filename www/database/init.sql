CREATE TABLE mail_logs (
    id integer NOT NULL,
    subject character varying,
    send_to character varying,
    body text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at timestamp without time zone
);