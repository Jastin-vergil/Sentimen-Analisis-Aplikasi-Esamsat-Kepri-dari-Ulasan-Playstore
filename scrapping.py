import pandas as pd
from google_play_scraper import Sort, reviews

APP_ID = "esamsat.kepri"

print("Mengambil ulasan ESamsat KEPRI...")

data, next_token = reviews(
    APP_ID,
    lang="id",
    country="id",
    sort=Sort.NEWEST,
    count=500
)

if data:
    ulasan = pd.DataFrame(data)

    ulasan = ulasan.rename(columns={
        "content": "Teks",
        "score": "Rating",
        "reviewId": "ID_Ulasan"
    })

    ulasan = ulasan[[
        "ID_Ulasan",
        "Teks",
        "Rating",
    ]]

    ulasan = ulasan.drop_duplicates(subset="ID_Ulasan")
    ulasan = ulasan.dropna(subset=["Teks"])
    ulasan = ulasan[ulasan["Teks"].str.strip() != ""]

    ulasan.to_csv(
        "dataset_ulasan.csv",
        index=False,
        encoding="utf-8-sig"
    )

    print("Scraping berhasil!")
    print("Jumlah ulasan:", len(ulasan))
    print("File: dataset_ulasan.csv")
    print(ulasan.head())
else:
    print("Belum ada ulasan yang berhasil diambil.")
