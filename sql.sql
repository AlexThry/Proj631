SELECT $ FROM book WHERE id in (SELECT id_book FROM has_genre WHERE id_genre in (SELECT id FROM genre WHERE label = 'fantasy'))