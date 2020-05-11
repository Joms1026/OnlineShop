// cara select gambar
SELECT b.ID, b.NAMA, k.NAMA_KATEGORI, GROUP_CONCAT("#",g.LINK_GAMBAR) as Gambar
FROM baju b
LEFT OUTER JOIN kategori k ON k.ID_KATEGORI = b.ID_KATEGORI
LEFT OUTER JOIN gambar g ON g.ID_BAJU=b.ID
GROUP by b.ID