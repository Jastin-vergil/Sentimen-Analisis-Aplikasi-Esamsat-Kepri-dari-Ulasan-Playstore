import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.svm import SVC
from sklearn.metrics import classification_report, accuracy_score, confusion_matrix

dataset = pd.read_csv('dataset_preprocessed.csv')

# 2. Tentukan pelabelan berdasarkan kolom Rating
def map_sentiment(rating):
    if rating >= 4:
        return 'Positif'
    elif rating == 3:
        return 'Netral'
    else:
        return 'Negatif'

dataset['label'] = dataset['Rating'].apply(map_sentiment)

# Gunakan teks yang sudah dibersihkan dari kolom dataset
X = dataset['teks_bersih'].fillna('')
y = dataset['label']

# 3. Split Data untuk train dan test
X_train, X_test, y_train, y_test = train_test_split(
    X, y, test_size=0.2, random_state=42, stratify=y
)

# 4. Ekstraksi Fitur TF-IDF
vectorizer = TfidfVectorizer(max_features=1000, ngram_range=(1, 2))
X_train_vec = vectorizer.fit_transform(X_train)
X_test_vec = vectorizer.transform(X_test)

# 5. Train Model Baseline SVM
baseline_svm = SVC(kernel='linear', C=1.0, random_state=42)
baseline_svm.fit(X_train_vec, y_train)

# 6. Evaluasi Performa
y_pred = baseline_svm.predict(X_test_vec)

print("=== Baseline Model SVM (Evaluasi Performa) ===")
print(f"Accuracy: {accuracy_score(y_test, y_pred):.4f}\n")
print("Classification Report:")
print(classification_report(y_test, y_pred))

print("\nConfusion Matrix:")
print(confusion_matrix(y_test, y_pred))
