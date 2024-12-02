--
-- PostgreSQL database dump
--

-- Dumped from database version 16.4
-- Dumped by pg_dump version 16.4

-- Started on 2024-12-02 19:15:12

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 4872 (class 1262 OID 25017)
-- Name: eventManagement; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE "eventManagement" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';


ALTER DATABASE "eventManagement" OWNER TO postgres;

\connect "eventManagement"

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 848 (class 1247 OID 25025)
-- Name: role; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.role AS ENUM (
    'organizer',
    'participant'
);


ALTER TYPE public.role OWNER TO postgres;

--
-- TOC entry 851 (class 1247 OID 25030)
-- Name: status; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.status AS ENUM (
    'confirmed',
    'pending',
    'canceled'
);


ALTER TYPE public.status OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 216 (class 1259 OID 25037)
-- Name: event; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.event (
    organizer_id integer NOT NULL,
    title character varying(100) NOT NULL,
    description text NOT NULL,
    date date NOT NULL,
    location character varying(100) NOT NULL,
    event_id integer NOT NULL
);


ALTER TABLE public.event OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 25044)
-- Name: eventRegistration; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."eventRegistration" (
    user_id integer NOT NULL,
    event_id integer NOT NULL,
    registration_date date DEFAULT CURRENT_DATE NOT NULL,
    status public.status NOT NULL,
    registration_id integer NOT NULL
);


ALTER TABLE public."eventRegistration" OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 25070)
-- Name: eventRegistration_registration_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."eventRegistration_registration_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."eventRegistration_registration_id_seq" OWNER TO postgres;

--
-- TOC entry 4873 (class 0 OID 0)
-- Dependencies: 218
-- Name: eventRegistration_registration_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."eventRegistration_registration_id_seq" OWNED BY public."eventRegistration".registration_id;


--
-- TOC entry 220 (class 1259 OID 25084)
-- Name: event_event_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.event_event_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.event_event_id_seq OWNER TO postgres;

--
-- TOC entry 4874 (class 0 OID 0)
-- Dependencies: 220
-- Name: event_event_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.event_event_id_seq OWNED BY public.event.event_id;


--
-- TOC entry 215 (class 1259 OID 25018)
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    name character varying(100) NOT NULL,
    email character varying(100) NOT NULL,
    join_date date DEFAULT CURRENT_DATE NOT NULL,
    role public.role NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 25077)
-- Name: user_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.user_user_id_seq OWNER TO postgres;

--
-- TOC entry 4875 (class 0 OID 0)
-- Dependencies: 219
-- Name: user_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_user_id_seq OWNED BY public."user".user_id;


--
-- TOC entry 4706 (class 2604 OID 25085)
-- Name: event event_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.event ALTER COLUMN event_id SET DEFAULT nextval('public.event_event_id_seq'::regclass);


--
-- TOC entry 4708 (class 2604 OID 25071)
-- Name: eventRegistration registration_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."eventRegistration" ALTER COLUMN registration_id SET DEFAULT nextval('public."eventRegistration_registration_id_seq"'::regclass);


--
-- TOC entry 4705 (class 2604 OID 25078)
-- Name: user user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user" ALTER COLUMN user_id SET DEFAULT nextval('public.user_user_id_seq'::regclass);


--
-- TOC entry 4862 (class 0 OID 25037)
-- Dependencies: 216
-- Data for Name: event; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.event (organizer_id, title, description, date, location, event_id) FROM stdin;
8	pdo	                                                      pdo                                                	2024-12-09	fakultas kedokteran	7
\.


--
-- TOC entry 4863 (class 0 OID 25044)
-- Dependencies: 217
-- Data for Name: eventRegistration; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."eventRegistration" (user_id, event_id, registration_date, status, registration_id) FROM stdin;
\.


--
-- TOC entry 4861 (class 0 OID 25018)
-- Dependencies: 215
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (name, email, join_date, role, user_id) FROM stdin;
testing	testing2@gmail.com	2024-12-02	participant	7
kabuki	kabuki@gmail.co	2024-12-02	organizer	8
ayam	ayam@gmail.com	2024-12-02	organizer	9
\.


--
-- TOC entry 4876 (class 0 OID 0)
-- Dependencies: 218
-- Name: eventRegistration_registration_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."eventRegistration_registration_id_seq"', 1, false);


--
-- TOC entry 4877 (class 0 OID 0)
-- Dependencies: 220
-- Name: event_event_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.event_event_id_seq', 8, true);


--
-- TOC entry 4878 (class 0 OID 0)
-- Dependencies: 219
-- Name: user_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_user_id_seq', 9, true);


--
-- TOC entry 4714 (class 2606 OID 25076)
-- Name: eventRegistration eventRegistration_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."eventRegistration"
    ADD CONSTRAINT "eventRegistration_pkey" PRIMARY KEY (registration_id);


--
-- TOC entry 4712 (class 2606 OID 25092)
-- Name: event event_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.event
    ADD CONSTRAINT event_pkey PRIMARY KEY (event_id);


--
-- TOC entry 4710 (class 2606 OID 25083)
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (user_id);


--
-- TOC entry 4716 (class 2606 OID 25103)
-- Name: eventRegistration fkey_eventid; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."eventRegistration"
    ADD CONSTRAINT fkey_eventid FOREIGN KEY (event_id) REFERENCES public.event(event_id) ON DELETE CASCADE NOT VALID;


--
-- TOC entry 4715 (class 2606 OID 25093)
-- Name: event fkey_userid; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.event
    ADD CONSTRAINT fkey_userid FOREIGN KEY (organizer_id) REFERENCES public."user"(user_id) ON DELETE CASCADE NOT VALID;


--
-- TOC entry 4717 (class 2606 OID 25098)
-- Name: eventRegistration fkey_userid; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."eventRegistration"
    ADD CONSTRAINT fkey_userid FOREIGN KEY (user_id) REFERENCES public."user"(user_id) ON DELETE CASCADE NOT VALID;


-- Completed on 2024-12-02 19:15:13

--
-- PostgreSQL database dump complete
--

