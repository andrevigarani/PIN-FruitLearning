import pandas as pd
from sklearn.model_selection import train_test_split, GridSearchCV, StratifiedKFold
from sklearn.svm import SVC
from sklearn.preprocessing import StandardScaler
from sklearn.metrics import classification_report, confusion_matrix
import joblib
import pickle

# Carregar os dados do arquivo CSV
data = pd.read_csv('frutas.csv')

# Separar características e rótulos
X = data.drop('classe', axis=1)
y = data['classe']

# Padronizar os dados
scaler = StandardScaler()
X_scaled = scaler.fit_transform(X)

# Dividir os dados em conjunto de treinamento e teste
X_train, X_val_test, y_train, y_val_test = train_test_split(X_scaled, y, test_size=0.3, random_state=42, stratify=y)
X_val, X_test, y_val, y_test = train_test_split(X_val_test, y_val_test, test_size=0.5, random_state=42, stratify=y_val_test)

# Ajustar hiperparâmetros (Grid Search)
param_grid = {
    'C': [0.1, 1, 10, 100],
    'gamma': [1, 0.1, 0.01, 0.001],
    'kernel': ['rbf', 'linear']
}

cv = StratifiedKFold(n_splits=5)
grid_search = GridSearchCV(estimator=SVC(class_weight='balanced'), param_grid=param_grid, cv=cv)
grid_search.fit(X_train, y_train)
best_model = grid_search.best_estimator_

# Avaliar modelo no conjunto de treinamento
y_train_pred = best_model.predict(X_train)
print(f"Acurácia no Treinamento: {best_model.score(X_train, y_train)}")
print(f"Relatório de Classificação no Treinamento:\n{classification_report(y_train, y_train_pred)}")
print(f"Matriz de Confusão no Treinamento:\n{confusion_matrix(y_train, y_train_pred)}")

# Avaliar modelo no conjunto de validação
y_val_pred = best_model.predict(X_val)
print(f"Acurácia na Validação: {best_model.score(X_val, y_val)}")
print(f"Relatório de Classificação na Validação:\n{classification_report(y_val, y_val_pred)}")
print(f"Matriz de Confusão na Validação:\n{confusion_matrix(y_val, y_val_pred)}")

# Salvar o modelo treinado e o scaler
with open('svm_model.pkl', 'wb') as f:
    pickle.dump((scaler, grid_search), f)
