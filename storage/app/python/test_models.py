import pandas as pd
import pickle
from sklearn.metrics import classification_report, confusion_matrix
from sklearn.model_selection import train_test_split

# Função para carregar os dados de teste
def load_test_data(file_path):
    data = pd.read_csv(file_path)
    X = data.drop('classe', axis=1)
    y = data['classe']
    _, X_test, _, y_test = train_test_split(X, y, test_size=0.15, random_state=42, stratify=y)
    return X_test, y_test

# Função para carregar um modelo junto com o scaler
def load_model_and_scaler(model_path):
    with open(model_path, 'rb') as f:
        scaler, model = pickle.load(f)
    return model, scaler

# Função para avaliar o modelo
def evaluate_model(model, scaler, X_test, y_test):
    # Padronizar os dados de teste
    X_test_scaled = scaler.transform(X_test)
    # Fazer previsões
    predictions = model.predict(X_test_scaled)
    # Avaliar o modelo
    print(confusion_matrix(y_test, predictions))
    print(classification_report(y_test, predictions))

# Caminhos dos arquivos
test_data_path = 'frutas.csv'
decision_tree_model_path = 'decision_tree_model.pkl'
svm_model_path = 'svm_model.pkl'

# Carregar os dados de teste
X_test, y_test = load_test_data(test_data_path)

# Carregar o modelo de Árvore de Decisão e o scaler
decision_tree_model, decision_tree_scaler = load_model_and_scaler(decision_tree_model_path)
# Carregar o modelo SVM e o scaler
svm_model, svm_scaler = load_model_and_scaler(svm_model_path)

# Avaliar o modelo de Árvore de Decisão
print("Avaliação do modelo de Árvore de Decisão:")
evaluate_model(decision_tree_model, decision_tree_scaler, X_test, y_test)

# Avaliar o modelo SVM
print("\nAvaliação do modelo SVM:")
evaluate_model(svm_model, svm_scaler, X_test, y_test)
